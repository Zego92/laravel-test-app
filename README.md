## Task

**Task:** Service which gets message from a queue (Redis or SQS/SNS) and sends out based on the template. Each channel should have its own queue.Message is described (but not limited to) by next attributes:

- channel (email/sms/slack/teams/webhook…etc)
- type (layout, ex. birthday digest/reminder/invitation with a link…etc)
- body (text or params containing message body)

Log function should reflect status of the outgoing message. In case of failure: 3 retries are available.Tech stack:

- laravel 10
- php 8.2
- docker-compose

In order to test the function console command can be used, which receives channel | type | body arguments.It is allowed to use trusted libs, ex https://laravel-notification-channels.com/https://laravel.com/docs/10.x/notifications

## Starting project
- docker-compose up -d

## Testing project
- php artisan migrate
- docker-compose exec api bash

## Example of command
- php artisan app:send-message --to='test@test.com' --channel=email --type=message --body='Hello world'
- php artisan queue:work --queue=email

