<h1>Exiva última morte</h1>
<div class="row">
    <div class="col-md-6">
        <label>Player</label>
        <input type="text" class="form-control" id="player">
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <button class="btn btn-primary" onclick="buscar()">Buscar</button>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-12">
        <h2>Personagem</h2>
        <ul id="personagemInfo">
            <!-- Informações do personagem serão inseridas aqui -->
        </ul>
    </div>
    <div class="col-md-12">
        <h2>Assassino</h2>
        <div class="list-group">
            <table class="table" id="assassinosTable">
                <tr>
                    <th>Personagem</th>
                    <th>Vocação</th>
                    <th>Level</th>
                    <th>Ação</th>
                </tr>
                <!-- Informações dos assassinos serão inseridas aqui -->
            </table>
        </div>
    </div>
</div>

<script>
function buscar() {
    var player = document.getElementById('player').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'server/exiva.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            document.getElementById('personagemInfo').innerHTML = '<li>Última Morte: ' + data.lastDeathDate + '</li>';
            var assassinosTable = document.getElementById('assassinosTable');
            assassinosTable.innerHTML = '<tr><th>Personagem</th><th>Vocação</th><th>Level</th><th>Ação</th></tr>';
            data.assassins.forEach(function(assassin) {
                var row = assassinosTable.insertRow(-1);
                row.insertCell(0).innerHTML = assassin.name;
                row.insertCell(1).innerHTML = assassin.vocation;
                row.insertCell(2).innerHTML = assassin.level;
                var actionsCell = row.insertCell(3);
                var exivaButton = document.createElement('button');
                exivaButton.className = 'btn btn-warning';
                exivaButton.innerHTML = 'Exiva';
                actionsCell.appendChild(exivaButton);
                var openSiteButton = document.createElement('button');
                openSiteButton.className = 'btn btn-danger';
                openSiteButton.innerHTML = 'Abrir Site';
                openSiteButton.onclick = function() {
                    window.open('https://www.tibia.com/community/?name=' + encodeURIComponent(assassin.name), '_blank');
                };
                actionsCell.appendChild(openSiteButton);
            });
        }
    };
    xhr.send('player=' + encodeURIComponent(player));
}
</script>
