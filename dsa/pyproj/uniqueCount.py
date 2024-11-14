# lst = [1, 3, 3, 5, 1, 3, 2]
# count_dict = {}
#
# for i in lst:
#     if i in count_dict:
#         count_dict[i] += 1
#     else:
#         count_dict[i] = 1
#
# sorted_dict = dict(sorted(count_dict.items(), key=lambda item: item[1], reverse=True))
#
# print(sorted_dict)

lst = [1, 3, 3, 5, 1, 3, 2]
num_list = []
cnt_list = []

for i in lst:
    if i not in num_list:
        num_list.append(i)
        cnt_list.append(lst.count(i))

# not finished
for i in range(len(num_list)):
    print(num_list[i], cnt_list[i],end=" ")