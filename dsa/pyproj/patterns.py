def right_triangle_patterns(n):
    # Right Triangle Pattern 1
    print("Right Triangle Pattern 1:")
    for i in range(n):
        for j in range(i + 1):
            print('*', end='')
        print()  # Move to the next line

    # Right Triangle Pattern 2
    print("\nRight Triangle Pattern 2:")
    for i in range(n):
        for j in range(n - i):
            print('*', end='')
        print()  # Move to the next line

    # Right Triangle Pattern 3
    print("\nRight Triangle Pattern 3:")
    for i in range(n):
        for j in range(n - i - 1):
            print(' ', end='')  # Print spaces
        for j in range(i + 1):
            print('*', end='')  # Print stars
        print()  # Move to the next line

    # Right Triangle Pattern 4
    print("\nRight Triangle Pattern 4:")
    for i in range(n):
        for j in range(i):
            print(' ', end='')  # Print spaces
        for j in range(n - i):
            print('*', end='')  # Print stars
        print()  # Move to the next line

def triangle_pattern(n):
    # Triangle Pattern
    print("\nTriangle Pattern:")
    for i in range(n):
        for j in range(n - i - 1):
            print(' ', end='')  # Print spaces
        for j in range(2 * i + 1):
            print('*', end='')  # Print stars
        print()  # Move to the next line

def upside_down_triangle_pattern(n):
    # Upside-Down Triangle Pattern
    print("\nUpside-Down Triangle Pattern:")
    for i in range(n):
        for j in range(i):
            print(' ', end='')  # Print spaces
        for j in range(2 * (n - i) - 1):
            print('*', end='')  # Print stars
        print()  # Move to the next line

# Set the number of rows
rows = 5
right_triangle_patterns(rows)
triangle_pattern(rows)
upside_down_triangle_pattern(rows)

