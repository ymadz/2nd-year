tup = ('a', 'b', 'a', 'c', 'c', 'a', 'b')
highest = ''
count = 0
arrIndex = []
length = len(tup)

for i in range(length):
    for j in range(length):
        currCount = tup.count(tup[i])
        if currCount > count:
            count = currCount
            highest = tup[i]

for i in range(length):
    if tup[i] == highest:
        arrIndex.append(i)

print(f"The most frequent element is '{highest}', appearing at positions: {arrIndex}")

