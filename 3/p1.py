# --- Day 3: Perfectly Spherical Houses in a Vacuum ---
#
# Santa is delivering presents to an infinite two-dimensional grid of houses.
#
# He begins by delivering a present to the house at his starting location, and
# then an elf at the North Pole calls him via radio and tells him where to move next.
# Moves are always exactly one house to the north (^), south (v), east (>), or west (<).
# After each move, he delivers another present to the house at his new location.
#
# However, the elf back at the north pole has had a little too much eggnog,
# and so his directions are a little off, and Santa ends up visiting some
# houses more than once. How many houses receive at least one present?
#
# For example:
#
# > delivers presents to 2 houses: one at the starting location, and one to the east.
# ^>v< delivers presents to 4 houses in a square, including twice to the house at his starting/ending location.
# ^v^v^v^v^v delivers a bunch of presents to some very lucky children at only 2 houses.


input = open("input.txt").read().replace('\n', '')
# input = '^v^v^v^v^v'

places = {'0|0': 1}
current = {'x': 0, 'y': 0}

for char in input:
    if char == '^':
        current['y'] -= 1
    if char == 'v':
        current['y'] += 1
    if char == '>':
        current['x'] += 1
    if char == '<':
        current['x'] -= 1

    key = str(current['y']) + '|' + str(current['x'])

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
