# Task system

Given the project description provided via email in this README file I'll be not only documenting the application itself, but also, the process in which I've developed this system.

I've broke the development into phases which will be listed below.

## Index

- Setting up
- Phases
    - Phase 1
    - Phase 2 -> in development
    - Phase 3

## Setting up

Firstly clone the repo and go inside de folder using the commands below:

```
git clone https://github.com/settle-real-state-mngmt/task-system.git
cd task-system
```

> The commands below assume you are in the folder of the cloned repo.

If you have composer, php, docker and docker-compose installed:

```
composer install
./vendor/bin/sail up
```

OR

```
docker-compose up -d
```

If you don't have compose and php installed but you have docker and docker-compose:

```
./composerinstall.sh
```

The command above runs a docker command using *laravelsail/php84-composer* image to run composer install in a container.

After that, you can just 

```
./vendor/bin/sail up -d
```

OR

```
docker-compose up -d
```

## Phases

### Phase 1

#### Understanding the requirements

Although the project description is already pretty broke into tasks I always find that story telling a little bit helps me define how the features are going to be define. With that, I can check the missing abstractions within the description allowing me to break it down the tasks more easily.

#### Store telling

SETTLE is a real state company that manages buildings around the world. The company is  focused on providing a services that helps people to manage their property. 

With that in mind they are developing a web system that allows their clients to register their buildings. In addition, they can also sign up their staff to the platform so they can assign tasks.

Each building has a list of task and you can assign your staff to a task. Also, a task has a title, description and comments.

Also you can filter the task by date range, task status or even user assignment.

### Phase 2

#### Breaking to tasks

In this phase my goal is to merge my story telling with the project description to them be able to create a more refined list of tasks.

By having this done I can organize better more phases of the project as necessary.

The phases are not meant to be static “written in stone” kind of thing, they are actually just a way of maintaining the focus on small steps allowing me to reiterate itself as I go.

#### Tasks

- [x] Add new organization called SETTLE
- [x] Add new repository called building-managent
- [x] Add laravel boilerplate
- [ ] Add docker-compose to use sail
- [ ] Add endpoint for user sign up
- [ ] Add endpoint for creating a new building
- [ ] The user who creates a building is the builder owner
- [ ] Add an endpoint to add a new staff
- [ ] Add an endpoint to create a task
- [ ] Add an endpoint to create comments for a task
- [ ] Add filter to the task endpoint
    - [ ] date range
    - [ ] status
    - [ ] staff assignment

### Phase 3

#### Breaking the broken Tasks

Now that the tasks are broken I have a pretty good idea about what is going to be developed. It is time to add grab each task and describe what needs to be done so development can start.

27/02/2025

- [x] Add docker-compose to use sail
- [ ] Add an endpoint so users can register
    - [ ] Add JWT Auth provided by PHP Open Saviour
    - [ ] Setting up according to https://laravel-jwt-auth.readthedocs.io/en/latest/
- [ ] Add an endpoint so user can create a building
    - [ ] Migration
    - [ ] Controller
    - [ ] Model
- [ ] Add an endpoint to create a staff
    - [ ] Migration
    - [ ] Controller
    - [ ] Model

### 

---

Credits to the author of this icon -> https://www.onlinewebfonts.com/icon/384109 
