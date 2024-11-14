# Sure! Let's break down some of the **commonly used functions** and **actions** for **strings**, **arrays (lists in Python)**, and **tuples**. This will give you a good foundation for working with these data types.
#
# ### 1. **String Functions and Actions**
#
# A **string** in Python is a sequence of characters, and there are many functions available to manipulate and interact with them.
# 
# #### Common String Functions:
#
# 1. **`len()`**: Returns the length of the string.
#    ```python
#    s = "hello"
#    print(len(s))  # Output: 5
#    ```
#
# 2. **`upper()` / `lower()`**: Converts the string to all uppercase or lowercase letters.
#    ```python
#    s = "Hello"
#    print(s.upper())  # Output: "HELLO"
#    print(s.lower())  # Output: "hello"
#    ```
#
# 3. **`strip()`**: Removes leading and trailing whitespace (or specific characters).
#    ```python
#    s = "  hello  "
#    print(s.strip())  # Output: "hello"
#    ```
#
# 4. **`split()`**: Splits the string into a list based on a delimiter (default is space).
#    ```python
#    s = "hello world"
#    print(s.split())  # Output: ['hello', 'world']
#    ```
#
# 5. **`join()`**: Joins elements of a list into a single string with a delimiter.
#    ```python
#    lst = ['hello', 'world']
#    print(" ".join(lst))  # Output: "hello world"
#    ```
#
# 6. **`find()` / `index()`**: Returns the position of the first occurrence of a substring. `find()` returns `-1` if not found, whereas `index()` raises an error.
#    ```python
#    s = "hello"
#    print(s.find('l'))  # Output: 2
#    ```
#
# 7. **`replace()`**: Replaces all occurrences of a substring with another substring.
#    ```python
#    s = "hello world"
#    print(s.replace("world", "Python"))  # Output: "hello Python"
#    ```
#
# 8. **String Slicing**: Extract parts of the string using indices.
#    ```python
#    s = "hello"
#    print(s[1:4])  # Output: "ell" (from index 1 to 3)
#    ```
#
# #### Actions:
# - **Concatenation**: Combine two strings using the `+` operator.
#   ```python
#   s1 = "hello"
#   s2 = "world"
#   print(s1 + " " + s2)  # Output: "hello world"
#   ```
#
# - **Repeating a String**: Multiply a string by an integer to repeat it.
#   ```python
#   s = "hi"
#   print(s * 3)  # Output: "hihihi"
#   ```
#
# ---
#
# ### 2. **Array (List) Functions and Actions**
#
# In Python, an **array** is represented by a **list**, which is an ordered collection of items.
#
# #### Common List Functions:
#
# 1. **`append()`**: Adds an element to the end of the list.
#    ```python
#    lst = [1, 2, 3]
#    lst.append(4)
#    print(lst)  # Output: [1, 2, 3, 4]
#    ```
#
# 2. **`extend()`**: Adds all elements of another list to the end of the list.
#    ```python
#    lst = [1, 2]
#    lst.extend([3, 4])
#    print(lst)  # Output: [1, 2, 3, 4]
#    ```
#
# 3. **`insert()`**: Inserts an element at a specific position.
#    ```python
#    lst = [1, 3, 4]
#    lst.insert(1, 2)  # Insert 2 at index 1
#    print(lst)  # Output: [1, 2, 3, 4]
#    ```
#
# 4. **`remove()`**: Removes the first occurrence of the element from the list.
#    ```python
#    lst = [1, 2, 3, 2]
#    lst.remove(2)  # Removes the first occurrence of 2
#    print(lst)  # Output: [1, 3, 2]
#    ```
#
# 5. **`pop()`**: Removes and returns the element at a given index (default is the last element).
#    ```python
#    lst = [1, 2, 3]
#    lst.pop()  # Removes and returns the last element (3)
#    print(lst)  # Output: [1, 2]
#    ```
#
# 6. **`len()`**: Returns the number of elements in the list.
#    ```python
#    lst = [1, 2, 3]
#    print(len(lst))  # Output: 3
#    ```
#
# 7. **`sort()`**: Sorts the list in ascending order (modifies the list).
#    ```python
#    lst = [3, 1, 2]
#    lst.sort()
#    print(lst)  # Output: [1, 2, 3]
#    ```
#
# 8. **`reverse()`**: Reverses the order of the elements in the list.
#    ```python
#    lst = [1, 2, 3]
#    lst.reverse()
#    print(lst)  # Output: [3, 2, 1]
#    ```
#
# 9. **List Slicing**: Extract parts of the list using indices.
#    ```python
#    lst = [1, 2, 3, 4, 5]
#    print(lst[1:4])  # Output: [2, 3, 4] (from index 1 to 3)
#    ```
#
# #### Actions:
# - **Concatenation**: Combine two lists using the `+` operator.
#   ```python
#   lst1 = [1, 2]
#   lst2 = [3, 4]
#   print(lst1 + lst2)  # Output: [1, 2, 3, 4]
#   ```
#
# - **Repetition**: Repeat a list using the `*` operator.
#   ```python
#   lst = [1, 2]
#   print(lst * 3)  # Output: [1, 2, 1, 2, 1, 2]
#   ```
#
# ---
#
# ### 3. **Tuple Functions and Actions**
#
# A **tuple** is similar to a list, but it is **immutable**, meaning that once you create a tuple, you cannot modify it.
#
# #### Common Tuple Functions:
#
# 1. **`len()`**: Returns the number of elements in the tuple.
#    ```python
#    tup = (1, 2, 3)
#    print(len(tup))  # Output: 3
#    ```
#
# 2. **`index()`**: Returns the index of the first occurrence of an element.
#    ```python
#    tup = (1, 2, 3)
#    print(tup.index(2))  # Output: 1
#    ```
#
# 3. **`count()`**: Returns the number of times an element appears in the tuple.
#    ```python
#    tup = (1, 2, 2, 3)
#    print(tup.count(2))  # Output: 2
#    ```
#
# 4. **Tuple Slicing**: Similar to lists and strings, you can extract parts of a tuple using indices.
#    ```python
#    tup = (1, 2, 3, 4)
#    print(tup[1:3])  # Output: (2, 3)
#    ```
#
# #### Actions:
# - **Concatenation**: Combine two tuples using the `+` operator.
#   ```python
#   tup1 = (1, 2)
#   tup2 = (3, 4)
#   print(tup1 + tup2)  # Output: (1, 2, 3, 4)
#   ```
#
# - **Repetition**: Repeat a tuple using the `*` operator.
#   ```python
#   tup = (1, 2)
#   print(tup * 3)  # Output: (1, 2, 1, 2, 1, 2)
#   ```
#
# ---
#
# ### Summary of Key Actions:
#
# | Action         | String Example     | List Example          | Tuple Example         |
# |----------------|--------------------|-----------------------|-----------------------|
# | **Length**     | `len(s)`            | `len(lst)`            | `len(tup)`            |
# | **Access**     | `s[0]`              | `lst[0]`              | `tup[0]`              |
# | **Slicing**    | `s[1:3]`            | `lst[1:3]`            | `tup[1:3]`            |
# | **Concatenation** | `s1 + s2`        | `lst1 + lst2`         | `tup1 + tup2`         |
# | **Repetition** | `s * 3`             | `lst * 3`             | `tup * 3`             |
# | **Sorting**    | `sorted(s)`         | `lst.sort()`          | *(Tuples can't be sorted)* |
# | **Mutability** | Immutable           | Mutable               | Immutable             |
#
# ---
#
# ### Key Differences:
#
# - **Strings** and **tuples** are **immutable**, meaning their contents cannot be changed