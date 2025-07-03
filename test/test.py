import subprocess
import os

TEST_DIR = './test'  
PHP_SCRIPT = 'public/index.php' 

def run_test(test_number):
    input_file = os.path.join(TEST_DIR, f'testfile{test_number}')
    output_file = os.path.join(TEST_DIR, f'testfile{test_number}.out')

    with open(output_file, 'r', encoding='utf-8') as f:
        expected = [line.strip() for line in f if line.strip()]
    with open(input_file, 'r', encoding='utf-8') as f_in:
        proc = subprocess.run(
            ['php', PHP_SCRIPT],
            stdin=f_in,
            capture_output=True,
            text=True
        )
    
    actual = [line.strip() for line in proc.stdout.splitlines() if line.strip()]

    if actual == expected:
        print(f"Test {test_number}: PASS")
    else:
        print(f"Test {test_number}: FAIL")
        print("Expected:")
        print("\n".join(expected))
        print("Actual:")
        print("\n".join(actual))

def main():
    for i in range(1, 8):
        run_test(i)

if __name__ == "__main__":
    main()
