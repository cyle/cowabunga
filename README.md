# Cowabunga.

## What? Huh?

I didn't believe the word clouds supplied by the final data analysis of the [Emerson Uncommon](https://communityplanit.org/emersonuncommon/) survey done by the Engagement Lab. So I did my own. I wanted to find where "cowabunga" landed.

## Getting the Data

Community Planit provides the "Emerson Uncommon" data [here](https://communityplanit.org/emersonuncommon/) in Excel format. There's the first hurdle to get over: Excel.

## Formatting the Data

So I opened it in Excel and deleted every superfluous column except for the ones that contain useful text data: "Response", "Response_ddqual", and "replies_ddqual". Next, in Excel I did a basic "Save As" to a CSV file. Unfortunately, Excel on Mac spits out a CSV that's not really usable by PHP because of its poor line ending choice. Next I had to open that CSV in TextMate and re-save it with standard Mac line endings. (This CSV is provided here as `emerson-uncommon.csv` if you'd like to use it.)

## Parsing the Data

Once that was done, I could open the CSV with PHP (basic install of 5.3+, no special libraries needed) and do a basic scrape of every word from each row. You can read the script `word-cloud.php` to see this in action. It also does a preliminary sweep to cut useless words.

## Making the Word Cloud

The script outputs a list of words and their frequency in a standard that would be acceptable to [this word cloud generator website](http://worditout.com/word-cloud/make-a-new-one). You can see this result in `word-cloud-results.txt`, or you can generate them yourself by running `php word-cloud.php`.

After copying and pasting that list of words into the word cloud website, I tweaked some of the word cloud settings and sizing, and came up with this:

![Oh look, a word cloud](word-cloud.png?raw=true)

## Cowabunga, dude.

Most importantly, I got the result I wanted:

![Cowabunga, dude.](word-cloud-cowabunga.png?raw=true)

## Notes

Go ahead and play with all of this if you want. I wanted to make this as open as possible so anyone could reproduce the same result. Cowabunga is _that_ important.