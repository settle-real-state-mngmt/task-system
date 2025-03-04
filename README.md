# Task system

Given the project description provided via email.
I've broke the development into phases which will be listed below.

## Index

- [Requirements](#Requeriments)
- [Setting up](#Setting up)
- [Technical requirements](#Technical Requirements)
- [Documentation](#Documentation)
	- [Database](#Database)



## Requirements

In order to run this project you either need to have docker and docker-compose installed OR php and composer.

## Setting up

Run the following commands:

```
git clone https://github.com/settle-real-state-mngmt/task-system.git
cd task-system
make install
```

The command make install will:

1. Install the project dependencies
2. Create a .env file
3. Run our containers configured by our docker-composel.yml
4. Generate a project key
5. Generate a jwt secret
6. Run our migrations and seeders

In case you do not have docker installed follow [this](https://github.com/settle-real-state-mngmt/task-system/wiki/Set-up-without-docker) section on the project wiki!

## Documentation

### Database

<mark style="background-color:red">test</mark>


## Technical requirements

- [ ] Develop an application using Laravel with REST architecture.
- [ ] Implement GET endpoint for listing tasks of a building along with their comments.
- [ ] Implement POST endpoint for creating a new task.
- [ ] Implement POST endpoint for creating a new comment for a task.
- [ ] Define the payload structure for task and comment creation, considering necessary relationships and information for possible filters.
- [ ] Implement filtering functionality, considering at least three filters such as date range of creation and assigned user, or task status and the building it belongs to.
- [ ] Containerize the application using Docker. 
- [ ] Type methods and parameters for improved code clarity. 
- [ ] Include descriptive PHPDoc in the methods.
