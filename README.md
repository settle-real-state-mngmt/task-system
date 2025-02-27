# Task system

Given the project description provided via email in this README file I'll be not only documenting the application itself, but also, the process in which I've developed this system.

I've broke the development into phases which will be listed below.

## Index

- Setting up
- Phases
    - Phase 1
    - Phase 2 -> in development
    - Phase 3

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

In this phase my goal is to merge my story telling with the project description to them be able to create a more refined list of tasks. This is done in colors so I can see what is done and from where they come from.

By having this done I can organize better more phases of the project as necessary.

The phases are not meant to be static “written in stone” kind of thing, they are actually just a way of maintaining the focus on small steps allowing me to reiterate itself as I go.

#### Tasks

- [x] Add new organization called SETTLE
- [x] Add new repository called building-managent
- [x] Add laravel boilerplate
- [ ] Add JWT Auth provided by PHP Open Saviour
- [ ] Setting up according to https://laravel-jwt-auth.readthedocs.io/en/latest/
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

---

Credits to the author of this icon -> https://www.onlinewebfonts.com/icon/384109 
