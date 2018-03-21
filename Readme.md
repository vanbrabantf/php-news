PHP News
======

It's a source code for website: https://php-news.com.

# What's the purpose?

This website is to get all interesting blog in PHP world. Notifications about new editions are automatically posted on [https://twitter.com/phpnewscom](Twitter).

# How to add your blog to the list?

It's not so difficult. Just create a pull request and add your blog to `config/packages/app.yaml` file. Here are some examples: 

```yaml
app:
  feeds:
      - id: iamcodeguru
        feedUrl: http://iamcode.guru/feed
        name: I Am Code Guru
        author: Bartłomiej Kiełbasa
        twitter: https://twitter.com/kabanek
        facebook: https://www.facebook.com/iamcodeguru/
```

Twitter and facebook are optional.

# Contributing

Wanna help? You can do this in few ways:

 * create a pull request with any improvement
 * create a pull request and add your blog there
 * create an issue and give me suggestion


# Local development

To make your changes locally you have to do few steps.

1. Step 1 - download the source code

```bash
git clone git@github.com:php-news/php-news.git
```

2. Install dependences

```bash
composer install
```

3. Fill up configuration in `.env`

It's a file where we keep any env-specific configuration. Setup database etc to have working application.

4. Prepare database

I use doctrine with it's migrations. The easiest way to have the database up-to-date is calling the following command:

```bash
./bin/console doctrine:migrations:migrate
```

4. Run it!

```bash
./bin/console server:run
```

and navigate to `http://127.0.0.1:8000`.

# Contributors

 * [Bartłomiej Kiełbasa](https://iamcode.guru) - project leader

