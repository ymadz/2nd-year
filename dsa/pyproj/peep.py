# print ("hello world")

# num1 = int(input("Enter a number: "))
# num2 = int(input("Enter another number: "))
# print(num1 + num2)
# print(num1 * num2)
# print(num1 / num2)
# print(num1 - num2)

# num1 = int(input("Enter a number: "))
# num2 = int(input("Enter another number: "))
# operator = input("Enter operator: ")
#
# match operator:
#     case '+':
#         print(num1 + num2)
#     case '-':
#         print(num1 - num2)
#     case '*':
#         print(num1 * num2)
#     case '/':
#         print(num1 / num2)

# num = int(input("Enter a number: "))
# if num%2 == 0:
#     print("Even")
# else:
#     print("Odd")

# fruits = ['apple', 'pear', 'orange', 'banana']
# for fruit in fruits:
#     print(fruit)

# sentence = input("Enter a sentence: ")
# vowels = ['a', 'e', 'i', 'o', 'u']
# count = []
#
# for i in vowels:
#     count.append(sentence.count(i))
#
# print(count)

fibonacci = [0,1]
num = int(input("Enter a number: "))
for i in range(num-2):
    fibonacci.append(fibonacci[-1] + fibonacci[-2])

if num == 1:
    fibonacci = [0]
print(fibonacci)