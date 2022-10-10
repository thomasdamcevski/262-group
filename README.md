# 262-group
Group assignment

## Installation

Install the requirements:
Docker, docker compose

Clone the repository:
- `git clone https://github.com/thomasdamcevski/262-group`
- `cd 262-group`

Run using docker
`docker-compose up`

Wait for setup to complete

Navigate to
`localhost:8000`
on your web browser

The database currently consists of:

| John  | Doe    | password    |
|-------|--------|-------------|
| Mary  | Moe    | 123456      |
| Julie | Dooley | password123 |

You can login as any of the users. To perform a simple SQL injection, instead of inputting the password input this:
` ' or '1'='1`
This will bypass the need for a password.
If you enter ` ' or '1'='1` for both the username and password, all records will be displayed.
