import {Component, Input, OnInit, Output, EventEmitter} from '@angular/core';
import {Task} from '../../models/task';
import {TaskService} from '../../services/task.service';

@Component({
  selector: 'app-task',
  templateUrl: './task.component.html',
  styleUrls: ['./task.component.scss']
})
export class TaskComponent implements OnInit {
  @Input()
  task : Task
  @Output()
  deleteTaskEvent = new EventEmitter()

  public date : Date
  constructor(private taskService: TaskService) { }

  ngOnInit(): void {
    this.date = new Date(this.task.created_at);
  }

  delete(){
    console.log(this.task)
    this.deleteTaskEvent.emit(
      this.task
    )
    this.taskService.Delete(this.task.id).subscribe()
  }

  toggleDone(){
    this.taskService.ToggleDone(this.task.id).subscribe()
    this.task.done = !this.task.done;
  }


}
