let GameManager = {
    setGameStart: function(classType) {
        this.resetPlayer(classType);
        this.setPreFight();
    },
    resetPlayer: function(classType) {
        switch (classType) {
            case "George Washington":
                player = new Player(classType, 200, 0, 200, 100, 50);
                break;
            case "Classic 'Murica":
                player = new Player(classType, 300, 0, 250, 50, 20);
                break;
            case "Traditional Bald Eagle":
                player = new Player(classType, 80, 0, 50, 200, 50);
                break;
            case "Abe Lincoln":
                player = new Player(classType, 200, 0, 50, 200, 100);
                break;
        }
        let getInterface = document.querySelector(".interface");
        if (classType === "Abe Lincoln") {
            getInterface.innerHTML = '<img src="img/avatar-player/' + classType + '.png" class="img-avatar"><div><h3>' + classType + '</h3><p class="health-player">Health: ' + player.health + '</p><p>Mana: ' + player.mana + '</p><p>Strength: ' + player.strength + '</p><p>Agilitiy: ' + player.agility + '</p><p>Speed: ' + player.speed + '</p></div>'; 
        } else {
            getInterface.innerHTML = '<img src="img/avatar-player/' + classType + '.jpg" class="img-avatar"><div><h3>' + classType + '</h3><p class="health-player">Health: ' + player.health + '</p><p>Mana: ' + player.mana + '</p><p>Strength: ' + player.strength + '</p><p>Agilitiy: ' + player.agility + '</p><p>Speed: ' + player.speed + '</p></div>';
        }
    },
    setPreFight: function() {
        let getHeader = document.querySelector(".header");
        let getActions = document.querySelector(".actions");
        let getArena = document.querySelector(".arena");

        getHeader.innerHTML = '<p>Task: Find an enemy!</p>';
        getActions.innerHTML = '<a href="#" class="btn-prefight" onclick="GameManager.setFight()">Search for enemy!</a>';
        getArena.style.visibility = "visible";
    },
    setFight: function() {
        let getHeader = document.querySelector(".header");
        let getActions = document.querySelector(".actions");
        let getEnemy = document.querySelector(".enemy");
        //Create enemy!
        let enemy0 = new Enemy("Darryl", 100, 0, 50, 100, 100);
        let enemy1 = new Enemy("Redneck", 200, 0, 150, 80, 150);
        let enemy2 = new Enemy("The Boss", 400, 0, 350, 50, 75);
        let chooseRandomEnemy = Math.floor((Math.random() * Math.floor(3)));

        switch (chooseRandomEnemy) {
            case 0:
                enemy = enemy0;
                break;
            case 1:
                enemy = enemy1;
                break;
            case 2:
                enemy = enemy2;
                break;
        }

        getHeader.innerHTML = '<p>Task: Choose your move!</p>';
        getActions.innerHTML = '<a href="#" class="btn-prefight" onclick="PlayerMoves.calcAttack()">Attack!</a>';
        if (enemy.enemyType === "Redneck") {
            getEnemy.innerHTML = '<img src="img/avatar-enemies/' + enemy.enemyType + '.png" class="img-avatar"><div><h3>' + enemy.enemyType + '</h3><p class="health-enemy">Health: ' + enemy.health + '</p><p>Mana: ' + enemy.mana + '</p><p>Strength: ' + enemy.strength + '</p><p>Agilitiy: ' + enemy.agility + '</p><p>Speed: ' + enemy.speed + '</p></div>'; 
        } else {
            getEnemy.innerHTML = '<img src="img/avatar-enemies/' + enemy.enemyType + '.jpg" class="img-avatar"><div><h3>' + enemy.enemyType + '</h3><p class="health-enemy">Health: ' + enemy.health + '</p><p>Mana: ' + enemy.mana + '</p><p>Strength: ' + enemy.strength + '</p><p>Agilitiy: ' + enemy.agility + '</p><p>Speed: ' + enemy.speed + '</p></div>';
        }
    }
}