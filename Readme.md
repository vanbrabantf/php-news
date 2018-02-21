PHP News
======

It's a source code for website: http://phpnews.com.

# What's the purpose?

This website is to get all interesting blog in PHP world.

# How to add your blog to the list?

It's not so difficult. Just create a pull request and add your blog to `config/packages/app.yaml` file. Here are some examples: 

```yaml
app:
  feeds:
    id: iamcodeguru
    feedUrl: http://iamcode.guru/feed
    name: I Am Code Guru
    author: Bartłomiej Kiełbasa
    twitter: https://twitter.com/kabanek
    facebook: https://www.facebook.com/iamcodeguru/
```

Twitter and facebook are optional.
