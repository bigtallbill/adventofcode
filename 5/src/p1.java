/*
--- Day 5: Doesn't He Have Intern-Elves For This? ---

Santa needs help figuring out which strings in his text file are naughty or nice.

A nice string is one with all of the following properties:

It contains at least three vowels (aeiou only), like aei, xazegov, or aeiouaeiouaeiou.
It contains at least one letter that appears twice in a row, like xx, abcdde (dd), or aabbccdd (aa, bb, cc, or dd).
It does not contain the strings ab, cd, pq, or xy, even if they are part of one of the other requirements.
For example:

ugknbfddgicrmopn is nice because it has at least three vowels (u...i...o...), a double letter (...dd...), and none of the disallowed substrings.
aaa is nice because it has at least three vowels and a double letter, even though the letters used by different rules overlap.
jchzalrnumimnmhp is naughty because it has no double letter.
haegwjzuvuyypxyu is naughty because it contains the string xy.
dvszwmarrgswjxmb is naughty because it contains only one vowel.
How many strings are nice?
 */

import java.io.IOException;
import java.nio.charset.Charset;
import java.nio.file.Files;
import java.nio.file.Paths;

public class p1 {

    public static String vowels = "aeiou";
    public static String[] excluded = {"ab", "cd", "pq", "xy"};

    public static void main(String[] args) throws IOException {

        String[] lines = loadInput();

//        String lines[] = {"ugknbfddgicrmopn"};

        int nice = 0;
        int naughty = 0;

        for (String line : lines) {
            String state = checkEntry(line);
            if (state.equals("nice")) {
                nice++;
            } else {
                naughty++;
            }
        }

        // Prints "Hello, World" to the terminal window.
        System.out.println(nice);
        System.out.println(naughty);
    }

    protected static String[] loadInput() throws IOException {
        String inputFile = readFile("/Users/bigtallbill/Documents/REPOS/adventofcode/5/input.txt", Charset.forName("utf8"));
        return inputFile.split("\\n");
    }

    protected static String readFile(String path, Charset encoding) throws IOException {
        byte[] encoded = Files.readAllBytes(Paths.get(path));
        return new String(encoded, encoding);
    }

    protected static String checkEntry(String input) {

        int numVowels = getNumVowels(input);
        boolean hasExcluded = hasExcluded(input);
        boolean hasDuplicateChars = hasDuplicateChars(input);

        String state = "naughty";

        if (numVowels >= 3 && !hasExcluded && hasDuplicateChars) {
            state = "nice";
        }
        return state;
    }

    protected static boolean hasDuplicateChars(String input) {
        boolean hasDuplicateChars = false;

        char prev = "-".charAt(0);
        for (int i = 0; i < input.length(); i++) {
            char current = input.charAt(i);

            if (i == 0) {
                prev = current;
                continue;
            } else if (prev == current) {
                hasDuplicateChars = true;
            }
            prev = current;
        }
        return hasDuplicateChars;
    }

    protected static boolean hasExcluded(String input) {
        boolean isExcluded = false;
        for (String excludedStr : excluded) {
            if (input.contains(excludedStr)) {
                isExcluded = true;
                break;
            }
        }
        return isExcluded;
    }

    protected static int getNumVowels(String input) {
        int numVowels = 0;
        for (int i = 0; i < vowels.length(); i++) {
            char vowel = vowels.charAt(i);

            for (int j = 0; j < input.length(); j++) {
                char inputChar = input.charAt(j);
                if (inputChar == vowel) {
                    numVowels++;
                }
            }
        }
        return numVowels;
    }
}
