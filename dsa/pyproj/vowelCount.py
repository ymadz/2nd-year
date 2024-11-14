# s = "hello world, python is fun."
# count_dict = {"a":0, "e":0, "i":0, "o":0, "u":0}
#
# for i in s:
#     if i in count_dict:
#         count_dict[i] += 1
#
# print(count_dict)

s = "hello world, python is fun."
vowels = ["a", "e", "i", "o", "u"]
final = []

for i in vowels:
    final.append(s.count(i))

print(final)