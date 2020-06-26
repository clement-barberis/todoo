import { Component, OnInit } from '@angular/core';
import {TaskService} from '../../services/task.service';
import {first} from 'rxjs/operators';
import {Task} from '../../models/task';

@Component({
  selector: 'app-tasks',
  templateUrl: './tasks.component.html',
  styleUrls: ['./tasks.component.scss']
})
export class TasksComponent implements OnInit {
  public tasks: Task[]

  constructor(private taskService: TaskService) {
    this.taskService.GetAll()
      .pipe(first())
      .subscribe(
        data => {
          this.tasks = data;
          console.log(this.tasks)
        },
        error => {
          console.log(error);
        });
  }

  ngOnInit(): void {
  }

  deleteTask(data){
    this.tasks = this.tasks.filter(item => item.id !== data.id)
  }



}
