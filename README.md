# Counter Strike game

## This is simulating the Counter Strike game in a special mode

--------------------------------------------------

#### You can see the question form of this exercise from the link below in `Farsi`:

#### https://quera.org/problemset/123805

#### Or read the text below in `English`:

--------------------------------------------------

Counter game is a first-person shooter game, in this game there are 2 teams with a maximum of 10 people. There is a "
Terrorist" team and a "Counter-Terrorist" team. The RR game has "hands" and in each hand the two teams shoot at each
other and try to destroy each other. The duration of each "hand" of the game is 02:15:000 (2 minutes and 15 seconds). If
none of the members of a team is alive at the end of a hand, they lose. If the game time ends and there is a player left
alive from both teams, the "anti-terrorist" team wins this hand. If in a hand no player is alive (or even no player
entered the game!) the anti-terrorist team wins.

### The weapons of this game:

Each player can buy a maximum of one weapon from the "Heavy" category and a maximum of one from the "Waist" category,
also each player has a "knife" by default. Buying weapons is only possible in the first 45 seconds of the game. In other
words, purchases after 00:45:00 (including this moment) are not made.

`Weapons of the terrorist team:`

**heavy weapon:**

| Name          | Price | Damage | Money amount |
|---------------|:-----:|-------:|--------------|
| AK            | 2700  |     31 | 100          |
| AWP           | 4300  |    110 | 50           |

**pistol weapon:**

| Name          | Price | Damage | Money amount |
|---------------|:-----:|-------:|--------------|
| Revolver      |  600  |     51 | 150          |
| Glock-18      |  300  |     11 | 200          |

**Knife:**

Everyone has this weapon, and it cannot be bought, every time it is used it reduces the life of the opposing player by
43 units, and if a player is killed with this weapon, $500 is immediately paid to the player who hit.
--------------------------------------------------------
`Weapons of the Counter terrorist team:`

**heavy weapon:**

| Name | Price | Damage | Money amount |
|------|:-----:|-------:|--------------|
| M4A1 | 2700  |     29 | 100          |
| AWP  | 4300  |    110 | 50           |

**pistol weapon:**

| Name         | Price | Damage | Money amount |
|--------------|:-----:|-------:|--------------|
| Desert-Eagle |  600  |     53 | 175          |
| UPS-S        |  300  |     13 | 225          |

**Knife:**

Everyone has this weapon, and it cannot be bought, every time it is used it reduces the life of the opposing player by
43 units, and if a player is killed with this weapon, $500 is immediately paid to the player who hit.
-------------------------------------

### The lives of the players and its importance:

At the beginning of each hand, each player has 100 health units. (Even if they were killed in the previous hand, they
will come back to life.) During the game, each of the players can shoot at each other, as a result of each shot,
depending on the gun that was shot, some life of the player that was shot at, decreases. If someone's health
reaches 0, they die and are out of the game and can no longer do anything. If a player shoots his teammate, nothing will
be lost. After killing every player from the opposing team, each player earns some "money" depending on their weapon
type. Someone gets a kill if they get that player to 0 for the first time. Note that no one's life is negative. That is,
if the life reduction rate of a shot is greater than the current value of the target player's life, the value of that
player's life becomes 0.
-----------------------------------------------

### Player money and its uses:

Players need money to buy weapons. Immediately after each player is added to the game, $1000 will be given to that
player. (A player may be added to the game in the middle of a hand.) After the end of each hand, each player of the
winning team is given $2,700 and each player of the losing team is given $2,400. Also, the maximum amount of money a
player can have is $10,000. That is, if the amount of money added to a player causes its money to be more than 10,000
dollars, we consider the amount of money of the player to be the same as 10,000 dollars.

-----------------------------------------------

### Times in the game:

To show the events of the game, at the end of each event, we print a time tag that is a string. The format of this
string is mm:ss:ttt, which shows the time in mm minutes, ss seconds and ttt milliseconds. For example, 01:48:932 means
this happened 1 minute 48 seconds and 932 milliseconds after the start of this game. It is guaranteed that the times of
each hand are given in such a way that no two events occur at the same time. Also, nothing happens at the beginning and
end of the hand. In fact, all event times are between 00:00:001 and 02:14:999. All events are guaranteed to be in
ascending order.

----------------------------------------------

### A hand of the game:

The times at the end of an event report are from the start time of that hand, not the start time of the first hand of
the game. When a player enters the game after 00:03:00 seconds (including this moment) in a hand, he enters the game as
dead (but this death is not counted among the number of times killed.) That is, this player's life is 0 and his money is
1000, and can start its activity from the next hand. Note that even a player who enters from the middle of the game will
receive the money he earns for winning or losing that hand. Players transfer their winnings from one hand to the next.
All players will have 100 life at the start of a hand. Regardless of whether they survived or died in the previous hand.
Living players carry their purchased weapons from one hand to the next, but dead players lose their weapons (except
knives) in the next hand.

We want you to write a program that will determine the state of the game and the score of the players by receiving
information about various game events.

After each hand is finished, print the name of the winning team. That is, if the terrorist team wins this hand, print
the word Terrorist won, and if the counter-terrorist team wins this hand, print the word Counter-Terrorist won.

--------------------------------------------
Guide to reading the instructions
The items inside `<>` mean that the appropriate value will be placed in their place.

Items that are separated by \ in [ ] means that exactly one of these items comes in the input.

Other items mean the same words with the same characters.

`<username>` and `<gun_name>` : is always a string with a length of at least 1 and maximum 20 characters, including
English upper and lowercase letters, numbers, or _ and - .

`<time>` : The format of this string is mm:ss:ttt, which shows the time in `mm` minutes, `ss` seconds and `ttt`
milliseconds.

Note that the system is sensitive to small and large letters.

----------------------------------------------------

## First phase:

**`ADD-USER` command:**

`ADD-USER <username> [Counter-Terrorist/Terrorist] <time>`

In this request, a person named `<username>` joins one of the terrorist or counter-terrorist teams at `<time>`.

`<username>` is always followed by exactly one of the strings Terrorist or Counter-Terrorist, which respectively
indicate the team this player joins.

If the following problems exist, you must print exactly one of the following errors in order. If several items occur
together, the item with a lower number should be done.

If a player (in each of these two teams) with such a username has already entered the game, print the message you are
already in this game.
If the capacity of the team that this player wants to join is complete. It means that at that moment there are 10
players in the team of this player, print the message this team is full.
Otherwise, add this player to the desired team and print the message this user added to `[Terrorist/Counter-Terrorist]`
and put the name of the team in the last string.

#### Example input from this command:

`ADD-USER RaB1t Terrorist 00:17:415`

`ADD-USER madam Counter-Terrorist 01:03:618`

------------------------------------------

**`GET-MONEY` command:**

`GET-MONEY <username> <time>`

In this command, we want you to print the amount of money of player `<username>` at the moment `<time>`.

If there is no player with the username `<username>` in the game at this moment, print the message invalid username.

#### Example input from this command:

`GET-MONEY Cat 00:43:151`

---------------------------------------------

**`GET-HEALTH` command:**

`GET-HEALTH <username> <time>`

In this command, we want you to print the amount of life of player `<username>` at the moment `<time>`.

If there is no player with the username `<username>` in the game at this moment, print the message invalid username.
Note
that if this player is dead, his life value is 0.

#### Example input from this command:

`GET-HEALTH Rajab 00:59:301`

---------------------------------------------------------

## Second phase:

**`TAP` command:**

`TAP <attacker> <attacked> [heavy/pistol/knife] <time>`

In this command, we declare that a player with the username `<attacker>` hits the player with the user name `<attacked>`
with his heavy weapon or pistol or knife at the moment `<time>`.

If one of the `<attacker>` or `<attacked>` players does not exist in the game at this moment, print the invalid username
message.
If `<attacker>` has been killed before this point, print the message attacker is dead.
If `<attacked>` was killed before this moment (not because of this shot), print the message attacked is dead.
If `<attacker>` does not have a gun of this type, print the message no such gun.
If both `<attacker>` and `<attacked>` are on the same team, print the friendly fire message.
Otherwise, record the shot and print the nice shot message.

#### Example input from this command:

`TAP RaB1t King2Krazy heavy 01:17:915`

`TAP A B knife 02:11:120`

-----------------------------------------------------

**`TAP` command:**

`BUY <username> <gun_name> <time>`

In this command, player `<username>` requests to buy gun `<gun_name>` at `<time>`.

If there is no player with the name `<username>` in the game, print the message invalid username.
If player `<username>` is not alive, print the message **"deads can not buy"**.
If `<time>` comes after the moment 00:45:00 (including this moment), print the message **"you are out of time"**.
If the gun `<gun_name>` is not in the list of authorized guns of the buying team, print the message invalid category
gun.
If a weapon of this category (heavy pistol) has already been purchased by this player, print the message you have
a `[heavy/pistol]`.
If this player does not have enough money to buy this weapon, print the message no enough money.
If none of the above events happen, print the message "I hope you can use it" and register the weapon for this player.

#### Example input from this command:

`BUY Dog M4A1 00:27:014`

----------------------------------------------

## Third phase:

**`SCORE-BOARD` command:**

`SCORE-BOARD <time>`

In this order, we ask you to print the list of players of the anti-terrorist and terrorist team.

For each player, we print the details of that player in one line:

`<rank> <username> <kills> <death>`

where `<username>` is the player's username, `<kills>` is the number of players killed by this player in all hands of
the
game before `<time>` (including this hand). `<killed>` is the number of times this player has been killed by another
player
in all hands up to `<time>` (including this hand). `<rank>` represents the player number. That is, for the player whose
profile is printed the first time, number 1, for the second player, number 2 and... These numberings are separate for
each team.

The profile of the player with the higher number of `<kills>` will be printed earlier, if two players have the same
number
of `<kills>`, the profile of the player with the lower number of `<killed>` will be printed earlier. If two players were
equal in both of these numbers, the player who entered the game earlier will be printed earlier.

To print the scoreboard, first print the words: Counter-Terrorist-Players in one line, which indicates that we want to
write this team's banner. Then we print the details of each player of the anti-terrorist team in one line according to
the above description. Then we print the expression: Terrorist-Players in the next line and in the next lines we print
the details of the players of the anti-terrorist team.

---------------------------------------------------------

## Input:

In the first line of input, there is an integer and positive number RR. which indicates the number of hands in this
entry.

## `1≤R≤15`

To indicate the beginning of each hand in a row, the word `ROUND` comes. It is followed by a spaced non-negative integer
nn indicating the number of instructions that have occurred in this hand. (Note that the value of nn can be equal to 0,
but we have at least one command in the whole game.)

It is guaranteed that the number of input orders will not exceed 2000.

To better understand the inputs, pay attention to the sample examples.

---------------------------------------------------------

## Output:

You should print the corresponding output in a separate line for each command in the input. Print the winning hand after
each hand is finished. That is, if the terrorist team wins this hand, print the expression `Terrorist won`, and if the
counter-terrorist team wins this hand, print the expression `Counter-Terrorist won` in a separate line.

----------------------------------------------------------

## Sample input 1:

`3` <br/>
`ROUND 6` <br/>
`ADD-USER King2Krazy Counter-Terrorist 00:01:130` <br/>
`ADD-USER Cat Terrorist 00:02:314` <br/>
`GET-MONEY King2Krazy 00:04:411`<br/>
`GET-MONEY Cat 00:04:715`<br/>
`GET-HEALTH King2Krazy 00:05:004`<br/>
`GET-HEALTH Cat 00:14:000`<br/>
`ROUND 1`<br/>
`TAP King2Krazy Cat knife 00:15:741`<br/>
`ROUND 8`<br/>
`TAP King2Krazy Cat knife 00:13:000`<br/>
`TAP King2Krazy Cat knife 00:15:001`<br/>
`TAP King2Krazy Cat knife 00:16:023`<br/>
`GET-MONEY King2Krazy 01:04:411`<br/>
`GET-MONEY Cat 01:04:715`<br/>
`GET-HEALTH King2Krazy 01:05:004`<br/>
`GET-HEALTH Cat 01:14:051`<br/>
`SCORE-BOARD 01:17:200`<br/>

## Sample output 1:

`this user added to Counter-Terrorist`<br/>
`this user added to Terrorist`<br/>
`1000`<br/>
`1000`<br/>
`100`<br/>
`100`<br/>
`Counter-Terrorist won`<br/>
`nice shot`<br/>
`Counter-Terrorist won`<br/>
`nice shot`<br/>
`nice shot`<br/>
`nice shot`<br/>
`6900`<br/>
`5800`<br/>
`100`<br/>
`0`<br/>
`Counter-Terrorist-Players:`<br/>
`1 King2Krazy 1 0`<br/>
`Terrorist-Players:`<br/>
`1 Cat 0 1`<br/>
`Counter-Terrorist won`<br/>

--------------------------------------------------------

## Sample input 2:

`1`<br/>
`ROUND 37`<br/>
`ADD-USER John-Wick Counter-Terrorist 00:00:541`<br/>
`ADD-USER Yuri-Boyka Counter-Terrorist 00:01:130`<br/>
`ADD-USER Bruce-Lee Terrorist 00:01:907`<br/>
`ADD-USER John-Wick Counter-Terrorist 00:02:181`<br/>
`ADD-USER johnwick Counter-Terrorist 00:03:777`<br/>
`GET-MONEY John-Wick 00:03:813`<br/>
`GET-HEALTH Bruce-Lee 00:04:465`<br/>
`GET-MONEY johnwick 00:05:000`<br/>
`BUY John-Wick AK 00:06:000`<br/>
`BUY John-Wick AWP 00:07:000`<br/>
`BUY John-Wick Desert-Eagle 00:08:000`<br/>
`BUY Yuri-Boyka M4A1 00:09:000`<br/>
`BUY Yuri-Boyka UPS-S 00:10:000`<br/>
`BUY Yuri-Boyka Desert-Eagle 00:11:000`<br/>
`BUY Bruce-Lee AK 00:12:000`<br/>
`BUY Bruce-Lee Glock-18 00:13:000`<br/>
`BUY johnwick Desert-Eagle 00:14:000`<br/>
`GET-MONEY John-Wick 00:15:000`<br/>
`GET-MONEY Yuri-Boyka 00:16:000`<br/>
`GET-MONEY Bruce-Lee 00:17:000`<br/>
`GET-MONEY johnwick 00:18:000`<br/>
`TAP John-Wick Yuri-Boyka heavy 00:19:000`<br/>
`TAP John-Wick Yuri-Boyka pistol 00:20:000`<br/>
`TAP John-Wick Yuri-Boyka knife 00:21:000`<br/>
`TAP Yuri-Boyka John-Wick heavy 00:22:000`<br/>
`TAP Yuri-Boyka John-Wick pistol 00:23:000`<br/>
`TAP Yuri-Boyka John-Wick knife 00:24:000`<br/>
`TAP Yuri-Boyka Bruce-Lee heavy 00:25:000`<br/>
`TAP Yuri-Boyka Bruce-Lee pistol 00:26:000`<br/>
`TAP Yuri-Boyka Bruce-Lee knife 00:27:000`<br/>
`TAP Bruce-Lee Yuri-Boyka heavy 00:28:000`<br/>
`TAP Bruce-Lee Yuri-Boyka pistol 00:29:000`<br/>
`TAP Bruce-Lee Yuri-Boyka knife 00:30:000`<br/>
`GET-HEALTH John-Wick 01:31:000`<br/>
`GET-HEALTH Yuri-Boyka 01:32:000`<br/>
`GET-HEALTH Bruce-Lee 01:33:000`<br/>
`GET-HEALTH johnwick 01:34:000`<br/>

## Sample output 2:

`this user added to Counter-Terrorist`<br/>
`this user added to Counter-Terrorist`<br/>
`this user added to Terrorist`<br/>
`you are already in this game`<br/>
`this user added to Counter-Terrorist`<br/>
`1000`<br/>
`100`<br/>
`1000`<br/>
`invalid category gun`<br/>
`no enough money`<br/>
`I hope you can use it`<br/>
`no enough money`<br/>
`I hope you can use it`<br/>
`you have a pistol`<br/>
`no enough money`<br/>
`I hope you can use it`<br/>
`deads can not buy`<br/>
`400`<br/>
`700`<br/>
`700`<br/>
`1000`<br/>
`no such gun`<br/>
`friendly fire`<br/>
`friendly fire`<br/>
`no such gun`<br/>
`friendly fire`<br/>
`friendly fire`<br/>
`no such gun`<br/>
`nice shot`<br/>
`nice shot`<br/>
`no such gun`<br/>
`nice shot`<br/>
`nice shot`<br/>
`100`<br/>
`46`<br/>
`44`<br/>
`0`<br/>
`Counter-Terrorist won`<br/>
