## Assignment


- Unlocking Achievements based on Lessons Watched and Comments Written.
- Unlocking Badges Based on achievements made .
- Endpoint that will return the following
    - unlocked_achievements
    - next_available_achievements
    - current_badge,
    - next_badge,
    - remaining_to_unlock_next_badge

## Installation

- Clone repository form github to your local machine
- From the root directory run `composer install`
- You must have a MySql database running locally
- Update the database details in ‘.env’ to match your local setup
- Run `php artisan migrate` to setup the database tables
- Run `php artisan db:seed` to use pre-seeded data

## Testing

- Run `php artisan test`

## Available Endpoint

- {{url}}/users/23/achievements

## Commands

- To create an achievement run `php artisan make:achievement name folder` e.g 
   `php artisan make:achievement FirstLessonWatched LessonsWatched`. This will create an achievement 
   by default the achievement name uses the Class name you can override that by adding a name property to 
   the class. Make sure to update the generated class which will be located in app/Achievements with the appropriate data
- To create a badge run `php artisan make:badge name points` e.g `php artisan make:badge Advanced 50`. This will create
    a badge located in app/Badge. Make sure to update the generated class accordingly.
- Make sure any new Badge Created should be updated and added in the BadgeService provider in the Laravel Provider directory.
- Make sure any new Achievement Created should be added in the AchievementServiceProvider in the Laravel Provider Directory.
# Note

- When either an achievement or a Badge its Created a class is generated which is tied to a model 
- The badges and achievements are cached after they are created so in case a new one is created you need to run
  `php aritsan cache:clear` on production
- If the AchievementUnlocked event is not triggered the Badges won't be unlocked and users won't have updated badge ids
