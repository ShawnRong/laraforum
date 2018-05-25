# Forum

- Thread
- Reply
- User

1. Thread created by User
2. A reply belongs to a thread, belongs to User


command:
- `php artisan make:model Thread -mc`
- `php artisan make:model Reply -mc`
- `php artisan make:auth`

table: 

thread
- user_id
- title
- body

reply
- user_id
- thread_id
- body
