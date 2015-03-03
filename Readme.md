## 🔥 Tinderweb <small style="color:#6d6d6d;font-weight:normal">&mdash; Tinder's missing web client.</small>

Tinderweb is a PHP web application which enables [tinder](http://gotinder.com) operation via web browser. The live version of this application can be accessed from [here](http://blahblah.blah).

## Requirements

* PHP 5.5 or later
* [Composer](https://getcomposer.com)
* Redis

## Running

If you doesn't trust me, or want to run tinderweb by yourself, copy `src/Config.php.example` to `src/Config.php`, and edit to match your environment.

If you want to run this application with [Vagrant](http://vagrantup.com), drag and drop the provided `config.yaml` file into [PuPHPet](http://puphpet.com)'s website, and place the content of this repo inside the `web` directory at the root of extracted vagrant config that you downloaded from PuPHPet.

## Testing

`todo`

## Technical

This web application is the part of my effort of learning the ‘correct’ way of implementing Object-Oriented and Programming Paradigms in PHP. The code is still far from perfect, and I hope that you can help to show me the ‘correct’ way to code 😊. Almost all codes are annotated and documented, so feel free to take a look inside. If there's something that can be optimized, send me a pull request, or you can discuss on twitter &mdash; @achmadmahardi.

The Tinder API endpoints documentation and implementations are taken from [Rich T.’s *tinder-api-documentation* gists](https://gist.github.com/rtt/10403467), and by inspecting the traffic from my Android Phone to Tinder using [mitmproxy](https://mitmproxy.org).

The main interface are rendered with Facebook’s [React.js](https://github.com/facebook/react) interface library, and uses [Flux]() paradigm to bind interfaces with data.

## Libraries Used

* silex
* league/oauth2-client
* doctrine/common
* filp/whoops
* dongww/silex-debugbar
* monolog/monolog
* twig
* phpunit
* React.js
* Reflux

## License

MIT

## Thanks to

@rtt

@Atriedes
