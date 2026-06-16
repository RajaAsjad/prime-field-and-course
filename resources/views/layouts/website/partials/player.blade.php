<div class="plyr" id="plyr">
  <div class="plyr-prog" id="pp" onclick="sk(event)"><div class="plyr-fill" id="pf" style="width:0%"></div></div>
  <div class="plyr-in">
    <div class="plyr-trk"><img class="plyr-thumb" id="pt" src="" alt=""><div><div class="plyr-ttl" id="pttl">Track</div><div class="plyr-art" id="part">{{ $site['name'] ?? 'Artist' }}</div></div></div>
    <div class="plyr-ctrls">
      <button type="button" class="plyr-btn" onclick="pv()" aria-label="Previous">⏮</button>
      <button type="button" class="plyr-play" id="ppb" onclick="tp()" aria-label="Play">▶</button>
      <button type="button" class="plyr-btn" onclick="pn()" aria-label="Next">⏭</button>
    </div>
    <div class="plyr-vol"><button type="button" class="plyr-vi" onclick="tm()">🔊</button><input class="vsl" type="range" min="0" max="1" step="0.05" value="0.8" oninput="sv(this.value)" aria-label="Volume"></div>
  </div>
</div>
