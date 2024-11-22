# FullCalendar

This module implements a Drupal integration of the 
[FullCalendar](https://fullcalendar.io/) the most popular 
full-sized JavaScript calendar. This Drupal module is only
compatible with the v6.1.x version of FullCalendar or later.

## Installation

1. Run composer require `drupal/fullcalendar` to download 
   the Drupal module to the `modules/contrib` folder and the
   library to the folder `libraries/fullcalendar_io`.

## Usage

  1. Enable Views, Date and Date Range modules.
  2. Create a new entity that has a date field.
  3. Create a view and add filters for the entity.
  4. In the "Format" section, change the "Format" to "FullCalendar".
  5. Enable the "Use AJAX" option under "Advanced" (Optional).

## Maintainers
[//]: # cSpell:disable
[//]: # Do not add maintainers to cspell-project-words file


- Martin Anderson-Clutz - [mandclu](https://www.drupal.org/u/mandclu)
- Jürgen Haas - [jurgenhaas](https://www.drupal.org/u/jurgenhaas)
