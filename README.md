# Linker

### Redirect user to specific url.

Example config:

```json
{
    "locale": "ru",
    "os": "android",
    "url": "http://google.com/ru",
    "child": {
        "locale": "en",
        "os": "android",
        "url": "http://google.com/en",
        "child": {
            "locale": "ru",
            "os": "ios",
            "url": "http://apple.com/ru",
            "child": {
                "locale": "en",
                "os": "ios",
                "url": "http://apple.com/en",
                "child": {
                    "url": "http://microsoft.com"
                }
            }
        }
    }
}
```

* Will redirect android with "ru" locale to http://google.com/ru"
* Android en -> http://google.com/en"
* iOS ru -> http://apple.com/ru"
* iOS en -> http://apple.com/en"
* Else -> http://microsoft.com"
