/* Copyleft 2014, all wrongs reversed */
/*jslint browser: true, vars: true*/
/*globals console,addHandler*/
/**
 *
 * Dungeon script
 * EDITED BY : Xiduzo
 * 21/06/2014
 *
*/

/**
 * hulp van:        http://stackoverflow.com/questions/24336493/another-uncaught-typeerror-undefined-is-not-a-function/24336567#24336567
 * basis formules:  http://tibia.wikia.com/wiki/Formula 
 * basis info voor waardes: http://tibia.wikia.com/wiki/Main_Page
 */

window.onload = function()
{
    'use strict';

    // -- FOR TIMING -- \\
        // onderstaande code van: http://stackoverflow.com/questions/9763441/milliseconds-to-time-in-javascript
        function msToTime(s)
        {
            var ms = s % 1000;
            s = (s - ms) / 1000;
            var secs = s % 60;
            s = (s - secs) / 60;
            var mins = s % 60;
            var hrs = (s - mins) / 60;

            //return hrs + " uur, " + mins +" minuten, en " + secs + '.' + ms + " seconde";
            return hrs + " uur, " + mins + " minuten en " + secs  + " seconde";
        }
    // -- FOR TIMING -- \\

    // -- FUNCTION HANDELING -- \\
        // Check if its a function
        function isFunction(test)
        {
            try 
            {
                return typeof eval(test) === "function";
            } 
            catch (error) 
            {
                return false;
            }
        }

        // Run the function 
        function runFunction(fn) 
        {
            eval(fn)();
        }

        // Clears the input field
        function clearCommand() 
        {
            command.value = "";
        }

        // Send input field as command to game
        function sendCommand(event) 
        {
            event.preventDefault();
            addLineToStory(">> " + command.value + " <<");

            if (isFunction(command.value)) 
            {
                runFunction(command.value);
            } 
            else 
            {
                addLineToStory("'" + command.value + "' is geen geldig commando, voer 'help' in om een lijst met  geldige commando's te bekijken.");
            }

            clearCommand();
        }
    // -- END FUNCTION HANDELING -- \\

    // -- EXTERN JSON FILE HANDELING -- \\
        /* MAKE DUNGEON VIA JSON */
            function buildDungeon(json)
            {
                dungeon = JSON.parse(json);
                enter(0);
            }
        /* END MAKE DUNGEON VIA JSON */

        /* LOAD JSON DATA */
            function  loadDataFile(filename) 
            {
                var xml = new XMLHttpRequest();
                xml.overrideMimeType("application/json");
                xml.open('GET', filename + '?' + new Date().getTime(), true);
                xml.onreadystatechange = function () 
                {
                    if (xml.readyState == 4) 
                    {
                        buildDungeon(xml.responseText);
                    }
                };
                xml.send(null);
            }
        /* END LOAD JSON DATA */
    // -- END EXTERN JSON FILE HANDELING -- \\

    // -- COMMAND HANDELING -- \\
        /**
         * Gives you all the possible input for the game
         */
        function help() {
            addLineToStory("'help' ==> Geef dit overzicht nogmaals weer.");
            addLineToStory("");
            addLineToStory("'attack' ==> Val aan.");
            addLineToStory("");
            addLineToStory("'potion' ==> Gebruik een potion.");
            addLineToStory("'buy' ==> Koop een potion.");
            addLineToStory("");
            addLineToStory("'items' ==> Kijk wat je allemaal meedraagt.");
            addLineToStory("'skills' ==> Kijk wat je skills zijn.");
            addLineToStory("");
            addLineToStory("'loot' ==> Loot monsters.");
            addLineToStory("'open' ==> Open chests.");
            addLineToStory("'pak' ==> Pak dingen op.");      
            addLineToStory("");
            getDirections();
        }

        /**
         * Get your input and respond to this
         * @param {String} name
         */
        function generateTransferFunction(name) 
        {
            return function () 
            {
                var transferToDungeonCode = dungeon[currentRoom].exits[name];

                if (transferToDungeonCode !== undefined) 
                {
                    enter(transferToDungeonCode);
                } 
                else 
                {
                    switch (command.value)
                    {
                        case "north":
                        case "east":
                        case "south":
                        case "west":
                            addLineToStory("Je rent hard tegen de muur op. Auw..");
                            break;
                        case "up":
                        case "down":
                            addLineToStory("Je kunt hier niet naar boven of onder");
                            break;
                        case "attack":
                            attackMonsterInRoom(); 
                            break;
                        case "items":
                            myStatus();
                            break;
                        case "skills":
                            mySkills();
                            break;
                        case "potion":
                            usePotion();
                            break;
                        case "open":
                        case "loot":
                            openThings();
                            break;
                        case "pak":
                            takeItem();
                            break;
                        case "buy":
                            buyPotion();
                            break;
                        default:
                            addLineToStory("ERROR ERROR");
                            break;
                    }
                    getDirections();
                }
            };
        }
    // -- END COMMAND HANDELING -- \\

    // -- STORY -- \\
        /**
         * Adds a line to the DOM
         * @param {String} line
        */
        function addLineToStory(line) 
        {
            story.value     += line + "\n";
            story.scrollTop = story.scrollHeight;
        }

        /**
         * Shows messages if you are game over
         */
        function gameOver()
        {
            endTime = new Date().getTime();
            seconds = endTime - startTime;
            alert("Je hebt helaas verloren ಥ_ಥ\n\nJe hebt er " + msToTime(seconds) + " over gedaan om zover te komen!\n\n\nDeze pagina herlaad zich automatisch en je kunt het spel nog een keertje spelen!");
            location.reload();
        }

        /**
         * Shows messages if you won the game (WOOT)
         */
        function gameWon()
        {
            endTime = new Date().getTime();
            seconds = endTime - startTime;
            alert("Je hebt gewonnen!!!! (✌ﾟ∀ﾟ)☞\n\nJe hebt er " + msToTime(seconds) + " over gedaan om te winnen!\n\n\nDeze pagina herlaad zich automatisch en je kunt het spel nog een keertje spelen, misschien verbreek je de tijd wel!");
            location.reload();
        }

        /**
         * Shows what you got in your inventory
         */
        function myStatus()
        {
            addLineToStory("");
            addLineToStory("In je backpack:");
            addLineToStory("");
            addLineToStory(myGold + " gold.");
            addLineToStory(myNumberOfPotions + " potion(s).");
            addLineToStory(myHealth + " van de " + myMaxHealt + " health over.");
            addLineToStory("");
            addLineToStory("Je equipment:");
            addLineToStory("");
            addLineToStory("Armor: " + myArmor.itemName + ".");
            addLineToStory("Wapen: " + myWeapon.itemName + ".");
            addLineToStory("Schild: " + myShield.itemName + ".");
        }

        /**
         * Shows your skills
         */
        function mySkills()
        {
            addLineToStory("");
            addLineToStory("~~Level: " + myLevelLvl + ".");
            addLineToStory("Level exp: " + myLevelExp + "/" + expNeededToLevelLevel  +"(" + percentToAdvance(myLevelExp, expNeededToLevelLevel) + "%)");
            addLineToStory("~~Attack: " + myAttackLvl + ".");
            addLineToStory("Attack exp: " + myAttackExp + "/" + expNeededToLevelAttack + "(" + percentToAdvance(myAttackExp, expNeededToLevelAttack) + "%)");
            addLineToStory("~~Defence: " + myDefenceLvl + ".");
            addLineToStory("Defence exp: " + myDefenceExp + "/" + expNeededToLevelDefence + "(" + percentToAdvance(myDefenceExp, expNeededToLevelDefence) + "%)");
        }

        /**
         * Get all the directions where you can go in the room you are
         */
        function getDirections() 
        {
            addLineToStory("");
            addLineToStory("Mogenlijke richtingen:");
            for (var exit in dungeon[currentRoom].exits) 
            {
                addLineToStory("--> " + exit);
            }
        }

        /**
         * What to do when you get in a new room
         * @param {Int} room
         */
        function enter(room) 
        {
            currentRoom = room;
            addLineToStory(dungeon[currentRoom].description);
            checkRoom();
            getDirections();
        }
    // -- END STORY -- \\

    // -- CALCULATIONS -- \\
        /* ATTACK */
            /**
             * Calculate your damage value
             * @param {String} myWeapon
             * @return {Int} myDamage
             */
            function dealDamage(myWeapon)
            {
                myDamage = myWeapon.itemAttack;
                return myDamage;
            }
        /* END ATTACK */

        /* DEFENCE */
        /**
         * Calculate your defence value
         * @param {String} myShield
         * @param {String} myArmor
         * @param {String} myWeapon
         * @return {Int} myDefence
         */
            function getDamage(myShield, myArmor, myWeapon)
            {
                myDefence = myShield.itemDefence + myArmor.itemDefence + myWeapon.itemDefence;
                return myDefence;
            }
        /* END DEFENCE */

        /* LEVELING */
            /**
             * Calculate how much exp you need to reach the next level
             * @param {Int} myAttackLvl
             * @return {Int} expNeededToLevelAttack
             */
            function expNeededToLevelAttack(myAttackLvl)
            {
                var expNeededToLevelAttack = Math.ceil(50 + Math.pow(1.1, (myAttackLvl - 20)));
                return expNeededToLevelAttack;
            }
            /**
             * Calculate how much exp you need to reach the next level
             * @param {Int} myDefenceLvl
             * @return {Int} expNeededToLevelDefence
             */
            function expNeededToLevelDefence(myDefenceLvl)
            {
                var expNeededToLevelDefence = Math.ceil(50 + Math.pow(1.1, (myDefenceLvl - 20)));
                return expNeededToLevelDefence;
            }
            /**
             * Calculate how much exp you need to reach the next level
             * @param {Int} myLevelLvl
             * @return {Int} expNeededToLeveLevel
             */
            function expNeededToLevelLevel(myLevelLvl)
            {
                var expNeededToLeveLevel = Math.ceil((50 * Math.pow(myLevelLvl,3) / 3) - (100 * Math.pow(myLevelLvl,2)) + (350 * myLevelLvl / 3) - 200);
                return expNeededToLeveLevel;
            }

            /**
             * Calculate how much % you are to advance to the next skill level
             * @param {Int} amount
             * @param {Int} amountNeeded
             * @return {Int} percentToAdvanceToNextLevel
             */
            function percentToAdvance(amount, amountNeeded)
            {
                var percentToAdvanceToNextLevel = Math.floor(amount / amountNeeded * 100);
                return percentToAdvanceToNextLevel;
            }
        /* END LEVELING */

        /* ADD HEALTH */
        /**
         * Increase your max health
         * @param {Int} amount
         * @return {Int} myMaxHealth
         */
        function increaseMyMaxHealt(amount)
        {
            myMaxHealt += amount;
            return myMaxHealt;
        }
        /* END ADD HEALTH */
    // -- END CALCULATIONS -- \\

    // -- OBJECTS IN STORY -- \\
        /**
         * Make a new monster
         * @param {String} name
         * @param {Int} health
         * @param {Int} attack
         * @param {Int} death
         * @param {Int} lootAmount
         * @param {Int} looted
        */
        function monster(name, health, attack, death, lootAmount, looted)
        {
            this.name       = name;
            this.health     = health;
            this.attack     = attack;
            this.death      = death;
            this.lootAmount = lootAmount;
            this.looted     = looted;
        }

        /**
         * Make a new chest
         * @param {Array} items
         * @param {Int} opened
        */
        function chest(items, opened)
        {
            this.items  = items
            this.opened = opened;
        }

        /**
         * Make a new healthPotion
         * @param {Int} gathered
        */
        function healthPotion(gathered)
        {
            this.gathered = gathered;
        }

        /**
         * New way of making items
         * @param {Int} itemID
         * @param {String} itemName
         * @param {Int} itemAttack
         * @param {Int} itemDefence
         */
        function equipment(itemName, type, itemAttack, itemDefence)
        {
            this.itemName       = itemName;
            this.type           = type; // 1 = weapon | 2 = schield | 3 = armor
            this.itemAttack     = itemAttack;
            this.itemDefence    = itemDefence;

        }
    // -- END OBJECTS IN STORY -- \\

    // -- MAKE OBJECTS IN STORY -- \\
        /**
         * Make the monsters for the game
         */
        var monster1    = new monster("Orc", 70, 100, 0, 50, 0);
        var monster2    = new monster("Assasin", 120, 140, 0, 100, 0);
        var monster3    = new monster("Wild Warrior", 155, 180, 0, 100, 0);
        var monster4    = new monster("Fire Devil", 190, 240, 0, 150, 0);
        var monsterBoss = new monster("Douta Dask", 260, 320, 0, 0);

        /**
         * Make the potions for the game
         */
        var potion1 = new healthPotion(0);
        var potion2 = new healthPotion(0);
        var potion3 = new healthPotion(0);

        /**
         * make the equipment for the game
         */
        var eq1 = new equipment("Spike Sword", 1, 24, 21);
        var eq2 = new equipment("Magic Longsword", 1, 55, 40);
        var eq3 = new equipment("Steel Shield", 2, 0, 21);
        var eq4 = new equipment("Blessed Shield", 2, 0 , 40);
        var eq5 = new equipment("Studded Armor", 3, 0, 5);
        var eq6 = new equipment("Magic Plate Armor", 3, 0, 17);

        /**
         * Make a chest with array items
         */
        var chest1 = new chest([eq2], 0);
        var chest2 = new chest([eq4], 0);
        var chest3 = new chest([eq6], 0);
    // -- END OBJECTS IN STORY -- \\

    // -- CHECK FOR OBJECTS IN ROOM -- \\
        /**
         * Check if there are items in the room
         */
        function checkRoom() 
        {
            addLineToStory("");
            switch(currentRoom)
            {
                case 3:
                    chestInRoom(chest1);
                    break;
                case 7:
                    monsterInRoom(monster1);
                    break;
                case 8:
                    potionInRoom(potion1);
                    break;
                case 9:
                    chestInRoom(chest2);
                    break;
                case 11:
                    potionInRoom(potion2);
                    break;
                case 12:
                    monsterInRoom(monster2)
                    break;
                case 14:
                    chestInRoom(chest3);
                    break;
                case 15:
                    monsterInRoom(monster3)
                    break;
                case 18:
                    potionInRoom(potion3);
                    break;
                case 19:
                    monsterInRoom(monster4);
                    break;
                case 20:
                    if(checkIfEveyThingIsSlain(monster1, monster2, monster3, monster4))
                    {
                        monsterInRoom(monsterBoss);
                    }
                    else
                    {
                        addLineToStory("Versla eerst alle monsters voordat je " + monsterBoss.name + " kunt verslaan!");
                    }
                    break;
                default:
                    addLineToStory("Deze kamer lijkt leeg te zijn... Ga verder met je avontuur");
                    break;
            }
        }

        /**
         * Check if the monster in the room is dead or not
         * @param {String} monster
        */
        function monsterInRoom(monster)
        {
            if (monster.death === 0)
            {
                addLineToStory("In deze kamer zit een " + monster.name + " ! Vlucht uit de kamer of ga dit monster te lijf met 'attack'.");
            }
            else
            {
                addLineToStory("In deze kamer ligt een dode " + monster.name + "."); 
            }
        }

        /**
         * Check for the chest in the room and if it's openend
         * @param {String} chest
        */
        function chestInRoom(chest)
        {
            if(chest.opened === 0)
            {
                addLineToStory("In deze kamer zie je een chest staan.");
            }
        }

        /**
         * Check for the potion in the room and if it's gathered
         * @param {String} potion
        */
        function potionInRoom(potion)
        {
            if (potion.gathered === 0)
            {
                addLineToStory("Er ligt iets in deze kamer maar het is niet goed te zien wat het nou precies is.");
            }
        }

        /**
         * Check if all the monsters are slain
         * @param {Array} monsters
         * @return {Boolean} true|false
         *
         */
        function checkIfEveyThingIsSlain(monsters)
        {
            for(var i=0; i<monsters.length; i++)
            {
                if(monsters[i].death === 0)
                {
                    return false
                }
            }
        }
    // -- END CHECK FOR OBJECTS IN ROOM -- \\
   
    // -- MAKE VARIABLES FOR THE GAME -- \\
        /* DUNGEON */
            var dungeon = {};
            var currentRoom = 0;

            /* Vier variabelen die verwijzen naar HTML elementen */
            var mud     = document.forms.mud;   // formulier
            var story   = mud.story;            // textarea
            var command = mud.command;          // input type=text
            var send    = mud.send;             // input type=submit
        /* END DUNGEON */

        /* YOUR ITEMS*/
            var myMaxHealt  = 300;
            var myHealth    = 300;
            var myGold      = 0;
            var myDamage    = 10;
            var myDefence   = 0;
            var myWeapon    = eq1;
            var myShield    = eq3;
            var myArmor     = eq5;
            var myNumberOfPotions   = 3;
            var healtIncreaseOnLvl  = 25;
            var potionPrice         = 50;
        /* END YOUR ITEMS */

        /* SKILL VARIABLES */
            /* MY LEVEL */
                var myLevelLvl      = 8;
                var myLevelExp      = 0;
            /* END MY LEVEL */
            /* ATTACK */
                var myAttackLvl     = 20;
                var myAttackExp     = 0;
            /* END ATTACK */

            /* DEFENCE */
                var myDefenceLvl    = 20;
                var myDefenceExp    = 0;
            /* END DEFENCE */

            /* EXP TO GAIN TOTAL*/
                var expNeededToLevelAttack      = expNeededToLevelAttack(myAttackLvl);
                var expNeededToLevelDefence     = expNeededToLevelDefence(myDefenceLvl);
                var expNeededToLevelLevel       = expNeededToLevelLevel(myLevelLvl);
            /* END EXP TO GAIN TOTAL */
        /* END SKILL VARIABLES */

        /* FOR BATTELING */
            var damageToMonster     = 0;
            var damageToMe          = 0;
            var totalDamage         = 0;
            var damage              = 0;
            var doMyDamage          = 0;
            var totalDamageMonster  = 0;
            var defence             = 0;
            var doMonsterDamage     = 0;
            var randomNumber        = 0;
        /* END FOR BATTELING */

        /* FOR HEALING */
            var healthToBeAdded  = 0;
        /* END FOR HEALING */

        /* FOR TIMING */
            var startTime   = 0;
            var endTime     = 0;
            var msPlayed    = 0; // Miliseconds
            var seconds     = 0;

            // Immediately start the time
            startTime = new Date().getTime();
        /* END FOR TIMING */
    // -- END VARIABLES FOR THE GAME -- \\

    // -- DO THINGS IN THE GAME -- \\
        /* COMBAT */
            /**
             * Check form monsters in the room
             * @param {String} monster
             */
            function attackMonsterInRoom(monster)
            {
                switch(currentRoom)
                {
                    case 7:
                        attackMonster(monster1);
                        break;
                    case 12:
                        attackMonster(monster2);
                        break;
                    case 15:
                        attackMonster(monster3)
                        break;
                    case 19:
                        attackMonster(monster4)
                        break;
                    case 20:
                        if(checkIfEveyThingIsSlain(monster1, monster2, monster3, monster4))
                        {
                            attackMonster(monsterBoss);
                        }
                        else
                        {
                            addLineToStory(monsterBoss.name+" is pas in deze kamer als je alle monsters hebt verslagen!");
                        }
                        break;
                    default:
                        addLineToStory("Je zwaait met je zwaard om je heen maar raakt niets.");
                        break;
                }
            }

            /**
             * Attack the monster in the room
             * @param {String} monster
             */
            function attackMonster(monster)
            {
                damageToMonster = doDamage();
                damageToMe      = monsterDamage(monster);

                if(monster.death === 0)
                {
                    if(damageToMe > 0)
                    {
                        myHealth -= damageToMe;
                    }
                    if(damageToMonster > 0)
                    {
                        monster.health -= damageToMonster;
                    }
                    checkMonsterHealth(monster, damageToMonster);
                    checkMyHealth(monster, damageToMe);
                    addAttackSkill();
                    addDefenceSkill();
                }
                else
                {
                    addLineToStory("Je hebt de " + monster.name + " al verslagen.");
                }
            }

            /**
             * Calulate your damage
             * @return {Int} totalDamage
             */
            function doDamage()
            {
                totalDamage = damageFormula();
                return totalDamage;
            }
            
            /**
             * Calculate the damage to deal to a monster
             * @return {Int} doDamage
             */
            function damageFormula()
            {
                damage = dealDamage(myWeapon);
                doMyDamage = Math.floor(0.045 * damage * myAttackLvl + (myLevelLvl/4) - (1+5*Math.random()));
                return doMyDamage;
            }

            /**
             * Calulate monster damage
             * @return {Int} totalDamageMonster
             */
            function monsterDamage(monster)
            {
                totalDamageMonster = defenceFormula(monster);
                return totalDamageMonster;
            }

            /**
             * Calculate the damage taken from a monster
             * @return {Int} totalDamage
             */
            function defenceFormula(monster)
            {
                defence = getDamage(myShield, myArmor, myWeapon);
                doMonsterDamage = Math.floor((monster.attack - (defence / 7) *(myDefenceLvl/5)) - (monster.attack / 100) * defence - (1+15*Math.random()));
                return doMonsterDamage;
            }

            /**
             * Leveling attack level
             * @return {Int} myAttackExp
             */
            function addAttackSkill()
            {
                randomNumber = Math.ceil(10 + 20*Math.random());
                myAttackExp += randomNumber;

                while(myAttackExp >= expNeededToLevelAttack)
                {
                    myAttackExp -= expNeededToLevelAttack;
                    myAttackLvl++;
                    addLineToStory("~~~~ ATTACK LEVEL INCREASED TO "+myAttackLvl+" ~~~~");
                }
                return myAttackExp;
            }

            /**
             * Leveling defence skill
             * @return {Int} myDefenceExp
             */
            function addDefenceSkill()
            {
                randomNumber = Math.ceil(10  + 25*Math.random());
                myDefenceExp += randomNumber;

                while (myDefenceExp >= expNeededToLevelDefence)
                {
                    myDefenceExp -= expNeededToLevelDefence;
                    myDefenceLvl++;
                    addLineToStory("~~~~ DEFENCE LEVEL INCREASED TO "+myDefenceLvl+" ~~~~");
                }
                return myDefenceExp;
            }

            /**
             * Leveling level ╚(•⌂•)╝
             * @return {Int} myLevelExp
             */
            function addLevelExp()
            {
                randomNumber = Math.ceil(2500 + 4000*Math.random());
                myLevelExp += randomNumber;

                while(myLevelExp >= expNeededToLevelLevel)
                {
                    myLevelExp -= expNeededToLevelLevel;
                    myLevelLvl++;
                    increaseMyMaxHealt(healtIncreaseOnLvl);
                    myHealth += healtIncreaseOnLvl;
                    addLineToStory("~~~~ LEVEL INCREASED TO "+myLevelLvl+" ~~~~");
                }
                return myLevelExp;
            }
            
            /**
             * Check the health of a monster after an attack
             * @param {String} monster
             * @param {Int} damage
             */
            function checkMonsterHealth(monster, damage)
            {
                if(monster.health >= 1)
                {
                    if(damage >= 0)
                    {
                        addLineToStory("Je hebt de " + monster.name + " [" + damage + "] schade aangericht.");
                    }
                    else
                    {
                        addLineToStory("Je hebt de " + monster.name + " gemist.");
                    }
                    addLineToStory("De " + monster.name + " heeft nog [" + monster.health + "] hitpoints over.");
                }
                else
                {
                    addLineToStory("Je hebt de " + monster.name + " verslagen.");
                    monster.death = 1;
                    addLevelExp();
                    if(monster.name === monsterBoss.name)
                    {
                        gameWon();
                    }
                }
            }

            /**
             * Check my health after an attack
             * @param {String} monster
             * @param {Int} damage
             */
            function checkMyHealth(monster, damage)
            {
                if(myHealth >= 1)
                {
                    if(damage <=0)
                    {
                        addLineToStory("Je hebt de aanval van " + monster.name + " afgeweerd.");
                    }
                    else
                    {
                        addLineToStory("De " + monster.name + " heeft jou ook {" + damage + "} schade aangericht.");
                    }
                    addLineToStory("Le hebt nog {" + myHealth + "} van de " + myMaxHealt + " health over.");
                }
                else
                {
                    gameOver();
                }
            }
        /* END COMBAT */

        /* OPEN THINGS */
            /**
             * Check if there is someting to open in the room
             */
            function openThings()
            {
                switch (currentRoom)
                {
                    case 0:
                        openChest(chest1);
                        break;
                    case 3:
                        openChest(chest1);
                        break;
                    case 7:
                        checkIfMonsterIsDeath(monster1);
                        break;
                    case 9:
                        openChest(chest2);
                        break;
                    case 12:
                        checkIfMonsterIsDeath(monster2);
                        break;
                    case 14:
                        openChest(chest3);
                        break;
                    case 15:
                        checkIfMonsterIsDeath(monster3);
                        break;
                    case 19:
                        checkIfMonsterIsDeath(monster4);
                        break;
                    default:
                        addLineToStory("Er valt niets te openen in deze room.");
                        break;
                }
            }

            /**
             * Open a chest in the room // this took a while to figure out, pretty proud of this piece of code ๏_๏
             * Even though i'm not using it's full potential ¯\(°_o)/¯ I could by just adding more items... much easier than how i did it before 
             * @param {Var} chest
             */
            function openChest(chest)
            {
                if(chest.opened === 0)
                {
                    for(var i=0; i<chest.items.length; i++)
                    {
                        switch(chest.items[i].type)
                        {
                            case 1:
                                addLineToStory("Je hebt een nieuw wapen gevonden: " + chest.items[i].itemName + "!");
                                myWeapon = chest.items[i];
                                break;
                            case 2:
                                addLineToStory("Je hebt een nieuw schild gevonden: " + chest.items[i].itemName + "!");
                                myShield = chest.items[i];
                                break;
                            case 3:
                                addLineToStory("Je hebt een nieuw armor gevonden: " + chest.items[i].itemName + "!");
                                myArmor = chest.items[i];
                                break;
                        }
                    }
                    chest.opened = 1; 
                }
                else
                {
                    addLineToStory("Je hebt deze chest al geopent.");
                }
            }

            /**
             * Check if the monster in the room is slain
             * @param {String} chest
             */
            function checkIfMonsterIsDeath(monster)
            {
                if (monster.death)
                {
                    lootMonster(monster);
                }
                else
                {
                    addLineToStory("Versla eerst de " + monster.naam + ".");
                }
            }

            /**
             * Loot the monster
             * @param {String} monster
             */
            function lootMonster(monster)
            {
                if(monster.looted === 0)
                {
                    addLineToStory("Je hebt de " + monster.name + " geopent en er zit " + monster.lootAmount +" gold in.");
                    myGold += monster.lootAmount;
                    monster.looted = 1;
                }
                else
                {
                    addLineToStory("Je hebt de " + monster.name + " al geloot.");
                }
            }

            /**
             * Take items from the room
             */
            function takeItem()
            {
                switch(currentRoom)
                {
                    case 8:
                        takePotion(potion1); 
                        break;
                    case 11:
                        takePotion(potion2);
                        break;
                    case 18:
                        takePotion(potion3);
                        break;
                    default:
                        addLineToStory("Er valt niets op te pakken in deze room.")
                        break;
                }  
            }

            /**
             * Take a potion from the room
             * @param {String} potion
             */
            function takePotion(potion)
            {
                if (potion.gathered === 0)
                {
                    addLineToStory("Je hebt een potion gevonden");
                    myNumberOfPotions ++;
                    potion.gathered = 1;  
                }
                else
                {
                    addLineToStory("Je hebt de potion in deze kamer al opgepakt");
                }
            }
        /* END OPEN THINGS */

        /* POTION HANDELING */
            /**
             * But a new potion
             */
            function buyPotion()
            {
                if (myGold >= potionPrice)
                {
                    myNumberOfPotions++;
                    myGold -= potionPrice;
                    addLineToStory("Je hebt een potion gekocht voor "+potionPrice+" gold, je hebt nu nog " + myNumberOfPotions + " potions en " + myGold + " gold over.");
                } 
                else 
                {
                    addLineToStory("Je hebt niet genoeg geld voor een potion te kopen, je hebt "+potionPrice+" gold nodig voor een potion. Je hebt nu " + myGold + " gold.");
                }
            }

            /**
             * Use potion
             */
            function usePotion()
            {             
                healthToBeAdded  = Math.floor(30 + 50 * Math.random()); // Number between 30 and 80 

                if (myNumberOfPotions >= 1)
                {
                    myNumberOfPotions--;
                    addHealth(healthToBeAdded);
                    addLineToStory("Je hebt nog " + myNumberOfPotions + " potions over.");
                } 
                else 
                {
                    addLineToStory("Je hebt geen potions meer, zoek of koop meer potions of ga door met " + myHealth + " health");
                }
            }

            /**
             * Add health
             */
            function addHealth(amount)
            {
                myHealth += amount;
                if (myHealth > myMaxHealt)
                {
                    var toMuchHealingIsBadForYou = myHealth - myMaxHealt; // I'm only using this variable here so I decided to make the var here instead by game variables, IF I'll be using it more this variable has to go to game variables!
                    amount   -= toMuchHealingIsBadForYou;
                    myHealth = myMaxHealt;
                    addLineToStory("Je hebt jezelf voor " + amount + " gehealed, je hebt op het moment " + myMaxHealt + " van de " + myMaxHealt + " health over.");
                }
                else
                {
                    addLineToStory("Je hebt jezelf voor " + amount + " gehealed, je hebt op het moment " + myHealth + " van de " + myMaxHealt + " health over.");
                }
            }
        /* END POTION HANDELING */
    // -- END OF DO THINGS IN GAME -- \\
    
    // -- COMMANDO'S -- \\
        /* DIRECTIONS */
            var north   = generateTransferFunction('north');
            var east    = generateTransferFunction('east');
            var south   = generateTransferFunction('south');
            var west    = generateTransferFunction('west');
            var up      = generateTransferFunction('up');
            var down    = generateTransferFunction('down');
        /* END DIRECTIONS */

        /* USER ACTIONS */
            var attack  = generateTransferFunction('attack');
            var open    = generateTransferFunction('open');
            var loot    = generateTransferFunction('loot');
            var pak     = generateTransferFunction('pak');
            var items   = generateTransferFunction('items');
            var skills  = generateTransferFunction('skills');
            var potion  = generateTransferFunction('potion');
            var buy     = generateTransferFunction('buy');
        /* END USER ACTIONS */
    // -- END COMMANDO'S -- \\

    // Voeg een handler toe om commando's te versturen
        addHandler(mud, "submit", sendCommand);

    // Laad de dungeon in
        loadDataFile('static/js/awesomud.json');

    // Zet de focus op het invoerveld
        command.focus();

    /* alles hieronder zit nog in de idee fase, maar heb ik geen tijd voor */

    // -- SHOWS THINGS IN BROWSER -- \\ haalt wel het hele concept van een text based game weg.... dus niet aan begonnen
        /* WEAPON */
        /* END WEAPON */

        /* SCHIELD */
        /* END SCHIELD */

        /* ARMOR */
        /* END ARMOR */

        /* SKILLS */
            /* LEVEL */
            /* END LEVEL */

            /* ATTACK */
            /* END ATTACK */

            /* DEFENCE */
            /* END DEFENCE */
        /* END SKILLS */
    // -- END SHHOS THINGS IN BROWSER -- \\    
};