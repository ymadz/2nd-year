# s = "python is fun to learn"
#
# # Step 1: Split the sentence into words
# words = s.split()
#
# # Step 2: Sort the list of words alphabetically
# sorted_words = sorted(words)
#
# print(sorted_words)

s = "python is fun to learn"

# Step 1: Manual splitting of the sentence into words
words = []
word = ""
for char in s:
    if char == " ":  # When encountering a space, add the word to the list
        if word:     # Avoid adding empty words (in case of multiple spaces)
            words.append(word)
            word = ""  # Reset word
    else:
        word += char  # Build the word character by character
if word:  # Append the last word
    words.append(word)

# Step 2: Manual sorting of the words (using bubble sort)
n = len(words)
for i in range(n):
    for j in range(0, n-i-1):
        if words[j] > words[j+1]:  # Compare two adjacent elements
            # Swap if they are in the wrong order
            words[j], words[j+1] = words[j+1], words[j]

print(words)

