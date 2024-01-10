# Parsing

To parse a file using the Laraparse package, first load it from the filesystem.

```
use Laracasts\LaraParse\Parse;

$parsed = Parse::file('path/to/file.md');
```

This will return an array of each paragraph from the Markdown file. You may loop over it.

```
use Laracasts\LaraParse\Parse;

$parsed = Parse::file('path/to/file.md');

$firstParagraph = $parsed[0];
```
