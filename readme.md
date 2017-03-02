# Hidden Admin

Hidden Admin is a SyDES plugin that can hide admin panel url
 
## Usage
 
After installation go to settings and change key and value.
Now if you are currently logged out and trying to access `/admin` you will catch NotFound error with front template.

Use url `/admin?yourKey=yourValue` to gain access.
