import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {first} from 'rxjs/operators';
import {TaskService} from '../../services/task.service';
import {Task} from '../../models/task';
import {Router} from '@angular/router';

@Component({
  selector: 'app-addtask',
  templateUrl: './addtask.component.html',
  styleUrls: ['./addtask.component.scss']
})
export class AddtaskComponent implements OnInit {
  formGroup: FormGroup;
  constructor(
    private taskService: TaskService,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.initForm();
  }

  // tslint:disable-next-line:typedef
  initForm(){
    this.formGroup = new FormGroup({
      title: new FormControl('', [Validators.required]),
      comment: new FormControl('')
    });
  }

  // convenience getter for easy access to form fields
  get f() { return this.formGroup.controls; }

  addTask(){
    if (this.formGroup.invalid){
      return;
    }

    console.log(this.f.title.value, this.f.comment.value)
    this.taskService.Post(new Task(this.f.title.value, this.f.comment.value))
      .pipe(first())
      .subscribe(
        data => {
          this.router.navigate(['/home/list']);
        },
        error => {
          console.log('Une erreur s\'est produite');
        });
  }

}
