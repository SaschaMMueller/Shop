- build container-image
-> e.g. Application image

- tests
  - unit tests (fast tests)
  - functional tests (slow tests)
  - end-to-end tests, browser automated tests

- deploy testEnviroment
  - info:
    - could be optional. depens on your amount of tests
    - needed mainly for browser automated tests
  - steps
    - environment setup
    - database setup

- tests (depends)
  - unit tests (fast tests)
  - functional tests (slow tests)
  - end-to-end tests, browser automated tests
   
- deploy to production environment
  - steps
    - environment setup
    - database setup
