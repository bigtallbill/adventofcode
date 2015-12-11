# --- Part Two ---
#
# The next year, to speed up the process, Santa creates a robot version of himself,
# Robo-Santa, to deliver presents with him.
#
# Santa and Robo-Santa start at the same location (delivering two presents to the
# same starting house), then take turns moving based on instructions from the elf,
# who is eggnoggedly reading from the same script as the previous year.
#
# This year, how many houses receive at least one present?
#
# For example:
#
# ^v delivers presents to 3 houses, because Santa goes north, and then Robo-Santa goes south.
# ^>v< now delivers presents to 3 houses, and Santa and Robo-Santa end up back where they started.
# ^v^v^v^v^v now delivers presents to 11 houses, with Santa going one direction and Robo-Santa going the other.


input = open("input.txt").read().replace('\n', '')
# input = '^v'

places = {'0|0': 1}
currentSanta = {'x': 0, 'y': 0}
currentRobot = {'x': 0, 'y': 0}

for index, char in enumerate(input):
    if index % 2 == 0:
        if char == '^':
            currentSanta['y'] -= 1
        if char == 'v':
            currentSanta['y'] += 1
        if char == '>':
            currentSanta['x'] += 1
        if char == '<':
            currentSanta['x'] -= 1

        key = str(currentSanta['y']) + '|' + str(currentSanta['x'])
    else:
        if char == '^':
            currentRobot['y'] -= 1
        if char == 'v':
            currentRobot['y'] += 1
        if char == '>':
            currentRobot['x'] += 1
        if char == '<':
            currentRobot['x'] -= 1

        key = str(currentRobot['y']) + '|' + str(currentRobot['x'])

    if key not in places:
        places[key] = 1
    else:
        places[key] += 1

numHousesMoreThanOne = 0
for coords, presents in places.iteritems():
    print coords, presents
    if presents >= 1:
        numHousesMoreThanOne += 1

print numHousesMoreThanOne
