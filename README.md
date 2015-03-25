instant-win
===========

PHP class for randomly awarding a fixed amount of instant-wins over a set period of time.

# Usage

See ```scripts/example-daily.php``` for an example of how to award 10 instant-wins each day (midnight to midnight), even when the 
number of instant-win attempts is variable or unknown.

```
$ ./scripts/example-daily.php
You won!!!
$ ./scripts/example-daily.php
Sorry, you did not win.
```