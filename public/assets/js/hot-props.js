(function () {
  const panel = document.getElementById('hot-props-panel');
  const tabsEl = document.getElementById('hot-props-tabs');
  const theadEl = document.getElementById('hot-props-thead');
  const bodyEl = document.getElementById('hot-props-body');
  const updatedEl = document.getElementById('hot-props-updated');
  const tournamentEl = document.getElementById('hot-props-tournament');
  const descEl = document.getElementById('hot-props-desc');

  if (!panel || !bodyEl) {
    return;
  }

  const endpoint = panel.dataset.endpoint;
  let refreshMs = Number(panel.dataset.refreshMs || 120000);
  let activeKey = panel.dataset.activeKey || 'top_5';
  let sportsbooks = [];
  let brackets = [];
  let refreshTimer = null;
  let isFetching = false;

  try {
    sportsbooks = JSON.parse(panel.dataset.sportsbooks || '[]');
  } catch (error) {
    sportsbooks = [];
  }

  const escapeHtml = (value) => String(value)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');

  const BRACKET_LIMITS = {
    top_5: 5,
    top_10: 10,
    top_20: 20,
  };

  const isBetMgmBook = (book) => String(book).replace(/\s+/g, '').toLowerCase() === 'betmgm';

  const formatDate = (iso) => {
    if (!iso) {
      return '';
    }

    return new Date(iso + 'T12:00:00').toLocaleDateString(undefined, {
      month: 'short',
      day: 'numeric',
      year: 'numeric',
    });
  };

  const renderTournament = (tournament) => {
    if (!tournamentEl || !tournament?.name) {
      return;
    }

    let html = escapeHtml(tournament.name);

    if (tournament.start_date) {
      html += ' &middot; ' + formatDate(tournament.start_date);

      if (tournament.end_date) {
        html += ' &ndash; ' + formatDate(tournament.end_date);
      }
    }

    tournamentEl.innerHTML = html;
  };

  const renderTabs = () => {
    if (!tabsEl) {
      return;
    }

    if (!Array.isArray(brackets) || brackets.length === 0) {
      return;
    }

    tabsEl.innerHTML = brackets.map((bracket) => {
      const isActive = bracket.key === activeKey;

      return `
        <button
          type="button"
          class="hot-props-tab${isActive ? ' is-active' : ''}"
          data-bracket-key="${escapeHtml(bracket.key)}"
          role="tab"
          aria-selected="${isActive ? 'true' : 'false'}"
        >${escapeHtml(bracket.label || bracket.key)}</button>
      `;
    }).join('');
  };

  const booksWithOdds = (rows) => {
    const present = sportsbooks.filter((book) =>
      rows.some((row) => Boolean(row?.odds?.[book]?.american))
    );

    return present.length ? present : sportsbooks;
  };

  const visibleBooksForBracket = (bracket) => {
    if (!bracket) {
      return sportsbooks;
    }

    const rows = bracket.type === 'yes_no'
      ? (bracket.outcomes || [])
      : (bracket.players || []);

    return booksWithOdds(rows);
  };

  const renderHead = (books) => {
    if (!theadEl) {
      return;
    }

    const bookHeaders = books.map((book) => `<th${isBetMgmBook(book) ? ' class="th-book-mgm"' : ''}>${escapeHtml(book)}</th>`).join('');

    theadEl.innerHTML = `
      <tr>
        <th style="min-width:180px;">Selection</th>
        ${bookHeaders}
      </tr>
    `;
  };

  const renderOddsCell = (odds) => {
    if (!odds?.american) {
      return '<td class="odds-cell">—</td>';
    }

    const bestClass = odds.best ? ' odds-cell-best' : '';

    return `<td class="odds-cell${bestClass}">${escapeHtml(odds.american)}</td>`;
  };

  const renderBracketBody = (bracket, books) => {
    const colspan = books.length + 1;

    if (!bracket) {
      return `
        <tr>
          <td colspan="${colspan}" style="text-align:center;padding:28px;color:#7a8a7e;">
            Prop odds are not available right now.
          </td>
        </tr>
      `;
    }

    if (bracket.type === 'yes_no') {
      const rows = bracket.outcomes || [];

      if (rows.length === 0) {
        return `
          <tr>
            <td colspan="${colspan}" style="text-align:center;padding:28px;color:#7a8a7e;">
              Odds not available for this market yet.
            </td>
          </tr>
        `;
      }

      return rows.map((row) => {
        const cells = books.map((book) => renderOddsCell(row.odds?.[book])).join('');

        return `
          <tr>
            <td><strong>${escapeHtml(row.label || 'Outcome')}</strong></td>
            ${cells}
          </tr>
        `;
      }).join('');
    }

    const limit = BRACKET_LIMITS[bracket.key];
    const players = limit ? (bracket.players || []).slice(0, limit) : (bracket.players || []);

    if (players.length === 0) {
      return `
        <tr>
          <td colspan="${colspan}" style="text-align:center;padding:28px;color:#7a8a7e;">
            Odds not available for this market yet.
          </td>
        </tr>
      `;
    }

    return players.map((player) => {
      const cells = books.map((book) => renderOddsCell(player.odds?.[book])).join('');

      return `
        <tr>
          <td><strong>${escapeHtml(player.name || 'Unknown')}</strong></td>
          ${cells}
        </tr>
      `;
    }).join('');
  };

  const renderActiveBracket = () => {
    if (!Array.isArray(brackets) || brackets.length === 0) {
      return;
    }

    const bracket = brackets.find((item) => item.key === activeKey) || brackets[0];

    if (bracket?.key) {
      activeKey = bracket.key;
      panel.dataset.activeKey = activeKey;
    }

    const books = sportsbooks;

    renderTabs();
    renderHead(books);
    bodyEl.innerHTML = renderBracketBody(bracket, books);
  };

  const renderUpdated = (payload) => {
    if (!updatedEl) {
      return;
    }

    if (payload.error && (!payload.brackets || payload.brackets.length === 0)) {
      updatedEl.textContent = payload.error;

      return;
    }

    const when = payload.updated_at
      ? new Date(payload.updated_at).toLocaleTimeString(undefined, { hour: 'numeric', minute: '2-digit' })
      : 'just now';

    updatedEl.textContent = `Last updated ${when}. Auto-refreshing every ${Math.round(refreshMs / 1000)} seconds.`;
  };

  const updateDesc = (seconds) => {
    if (!descEl || !seconds) {
      return;
    }

    descEl.textContent = `Consensus and sportsbook prop odds via SportsDataIO Sportsbook Group. Auto-refreshes every ${seconds} seconds.`;
  };

  const applyPayload = (payload) => {
    if (Array.isArray(payload.sportsbooks) && payload.sportsbooks.length > 0) {
      sportsbooks = payload.sportsbooks;
      panel.dataset.sportsbooks = JSON.stringify(sportsbooks);
    }

    brackets = Array.isArray(payload.brackets) ? payload.brackets : [];

    if (!brackets.some((bracket) => bracket.key === activeKey)) {
      activeKey = payload.active_key || brackets[0]?.key || activeKey;
    }

    if (payload.refresh_seconds) {
      refreshMs = Number(payload.refresh_seconds) * 1000;
      panel.dataset.refreshMs = String(refreshMs);
      updateDesc(payload.refresh_seconds);
    }

    renderTournament(payload.tournament);
    renderActiveBracket();
    renderUpdated(payload);
  };

  const fetchProps = async () => {
    if (!endpoint || isFetching) {
      return;
    }

    isFetching = true;

    try {
      const response = await fetch(endpoint, {
        headers: { Accept: 'application/json' },
        cache: 'no-store',
      });

      if (!response.ok) {
        throw new Error('Hot props request failed');
      }

      applyPayload(await response.json());
    } catch (error) {
      if (updatedEl) {
        updatedEl.textContent = 'Unable to refresh prop odds right now.';
      }
    } finally {
      isFetching = false;
    }
  };

  const scheduleRefresh = () => {
    if (refreshTimer) {
      clearInterval(refreshTimer);
    }

    refreshTimer = setInterval(fetchProps, refreshMs);
  };

  tabsEl?.addEventListener('click', (event) => {
    const button = event.target.closest('[data-bracket-key]');

    if (!button || !tabsEl.contains(button)) {
      return;
    }

    event.preventDefault();

    const nextKey = button.dataset.bracketKey;

    if (!nextKey || nextKey === activeKey) {
      return;
    }

    activeKey = nextKey;
    panel.dataset.activeKey = activeKey;
    renderActiveBracket();
  });

  fetchProps();
  scheduleRefresh();
})();
