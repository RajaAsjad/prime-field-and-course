(function () {
  const table = document.getElementById('live-odds-table');
  const updatedEl = document.getElementById('live-odds-updated');
  const tournamentEl = document.getElementById('live-odds-tournament');
  const weatherEl = document.getElementById('tournament-weather');
  const descEl = document.getElementById('live-odds-desc');

  if (!table) {
    return;
  }

  const endpoint = table.dataset.endpoint;
  let refreshMs = Number(table.dataset.refreshMs || 60000);
  let sportsbooks = [];

  try {
    sportsbooks = JSON.parse(table.dataset.sportsbooks || '[]');
  } catch (error) {
    sportsbooks = [];
  }

  let refreshTimer = null;
  let isFetching = false;

  const escapeHtml = (value) => String(value)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');

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

    if (tournament.is_in_progress) {
      html += ' &middot; <span style="color:var(--g-600);font-weight:700;">Live</span>';
    }

    tournamentEl.innerHTML = html;
  };

  const renderWeather = (weather) => {
    if (!weatherEl) {
      return;
    }

    if (!weather) {
      weatherEl.innerHTML = '<span class="tournament-weather__loading">Weather unavailable for this venue.</span>';

      return;
    }

    const venue = weather.venue
      ? ` &middot; ${escapeHtml(weather.venue)}`
      : '';
    const humidity = weather.humidity
      ? ` &middot; ${escapeHtml(weather.humidity)}% humidity`
      : '';

    weatherEl.innerHTML = `
      <div class="tournament-weather__icon tournament-weather__icon--${escapeHtml(weather.icon)}" aria-hidden="true"></div>
      <div class="tournament-weather__body">
        <div class="tournament-weather__temp">${escapeHtml(weather.temperature)}&deg;F</div>
        <div class="tournament-weather__condition">${escapeHtml(weather.condition)}</div>
        <div class="tournament-weather__meta">
          ${escapeHtml(weather.location)}${venue}
          &middot; Wind ${escapeHtml(weather.wind_mph)} mph${humidity}
        </div>
      </div>`;
  };

  const renderDescription = (isLive, refreshSeconds) => {
    if (!descEl) {
      return;
    }

    const seconds = refreshSeconds || Math.round(refreshMs / 1000);
    descEl.textContent = isLive
      ? `Best available odds across top sportsbooks. Green highlights best value. Live scores & odds refresh every ${seconds} seconds.`
      : `Best available odds across top sportsbooks. Green highlights best value. Auto-refreshes every ${seconds} seconds.`;
  };

  const renderScoreCell = (player, isLive) => {
    const score = player.score;

    if (!score?.to_par) {
      return '<td class="score-col"><span class="psl">&mdash;</span></td>';
    }

    const scoreClass = isLive ? 'score-val score-live' : 'score-val';
    const rank = score.rank ? `<br><span class="score-meta">T${escapeHtml(score.rank)}</span>` : '';
    let thru = '';

    if (score.through) {
      thru = `<br><span class="score-meta">${Number(score.through) >= 18 ? 'F' : `thru ${escapeHtml(score.through)}`}</span>`;
    }

    return `<td class="score-col"><span class="${scoreClass}">${escapeHtml(score.to_par)}</span>${rank}${thru}</td>`;
  };

  const renderTable = (data) => {
    const books = data.sportsbooks?.length ? data.sportsbooks : sportsbooks;
    sportsbooks = books;
    table.dataset.sportsbooks = JSON.stringify(books);

    const headCells = books.map((book) => `<th>${escapeHtml(book)}</th>`).join('');
    const players = data.players || [];
    const isLive = Boolean(data.is_live);
    const colspan = books.length + 2;

    let bodyHtml = '';

    if (!players.length) {
      bodyHtml = `
        <tr id="live-odds-empty">
          <td colspan="${colspan}" style="text-align:center;padding:28px;color:#7a8a7e;">
            ${escapeHtml(data.error || 'No live odds available for the current tournament.')}
          </td>
        </tr>`;
    } else {
      bodyHtml = players.map((player) => {
        const oddsCells = books.map((book) => {
          const odds = player.odds?.[book];

          if (!odds) {
            return '<td><span class="psl">&mdash;</span></td>';
          }

          const bestClass = odds.best ? ' ov-best' : '';

          return `<td><span class="ov${bestClass}">${escapeHtml(odds.american)}</span></td>`;
        }).join('');

        return `
          <tr>
            <td>
              <span class="pname">${escapeHtml(player.name)}</span><br>
              <span class="psl" style="color:#9aaa9e">${escapeHtml(player.subtitle || '')}</span>
            </td>
            ${renderScoreCell(player, isLive)}
            ${oddsCells}
          </tr>`;
      }).join('');
    }

    table.innerHTML = `
      <thead>
        <tr>
          <th style="min-width:180px;">Player / Tournament</th>
          <th class="score-col">Score</th>
          ${headCells}
        </tr>
      </thead>
      <tbody id="live-odds-body">${bodyHtml}</tbody>`;
  };

  const renderUpdated = (updatedAt, isLive) => {
    if (!updatedEl) {
      return;
    }

    if (!updatedAt) {
      updatedEl.textContent = 'Updating automatically…';
      return;
    }

    const date = new Date(updatedAt);
    let text = 'Updated ' + date.toLocaleTimeString(undefined, {
      hour: 'numeric',
      minute: '2-digit',
      second: '2-digit',
    });

    text += isLive ? ' · Live scoring active' : ' · Auto-refresh on';

    updatedEl.textContent = text;
  };

  const scheduleRefresh = () => {
    if (refreshTimer) {
      window.clearInterval(refreshTimer);
    }

    refreshTimer = window.setInterval(refreshOdds, refreshMs);
  };

  const refreshOdds = async () => {
    if (isFetching || !endpoint) {
      return;
    }

    isFetching = true;

    try {
      const url = new URL(endpoint, window.location.origin);
      url.searchParams.set('_', String(Date.now()));

      const response = await fetch(url.toString(), {
        headers: {
          Accept: 'application/json',
          'Cache-Control': 'no-cache',
        },
        cache: 'no-store',
      });

      if (!response.ok) {
        throw new Error('Request failed');
      }

      const data = await response.json();
      const nextRefreshMs = Number(data.refresh_seconds || 0) * 1000;

      if (nextRefreshMs > 0 && nextRefreshMs !== refreshMs) {
        refreshMs = nextRefreshMs;
        table.dataset.refreshMs = String(refreshMs);
        scheduleRefresh();
      }

      renderTournament(data.tournament);
      renderWeather(data.weather);
      renderDescription(data.is_live, data.refresh_seconds);
      renderTable(data);
      renderUpdated(data.updated_at, data.is_live);
    } catch (error) {
      if (updatedEl) {
        updatedEl.textContent = 'Unable to refresh. Retrying automatically…';
      }
    } finally {
      isFetching = false;
    }
  };

  refreshOdds();
  scheduleRefresh();

  document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'visible') {
      refreshOdds();
    }
  });
})();
