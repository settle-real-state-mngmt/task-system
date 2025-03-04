<?php

namespace App;

enum TaskStatus: string
{
    case Open = 'Open';
    case InProgress = 'In Progress';
    case Completed = 'Completed';
    case Rejected = 'Rejected';
}
