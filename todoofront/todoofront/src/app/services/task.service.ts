import {Injectable} from '@angular/core';
import {BehaviorSubject, Observable} from 'rxjs';
import {HttpClient} from '@angular/common/http';
import {map} from 'rxjs/operators';
import {environment} from '../../environments/environment';
import { User} from '../models/user';
import {Task} from '../models/task';

@Injectable({providedIn: 'root'})
export class TaskService {
  private currentUserSubject: BehaviorSubject<User>;
  public currentUser: Observable<User>;

  constructor(private http: HttpClient) {
    this.currentUserSubject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('currentUser')));
  }

  GetAll() {
    return this.http.get<Task[]>(`${environment.api_url_base}/api/tasks`)
      .pipe(map(tasks => {
        return tasks;
      }));
  }

  Post(Task){
    return this.http.post<Task>(`${environment.api_url_base}/api/tasks`, Task)
      .pipe(map(task => {
        return task;
      }));
  }

  Delete(id){
    return this.http.delete(`${environment.api_url_base}/api/tasks/${id}`)
      .pipe(map(task => {
        return task;
      }));
  }

  ToggleDone(id){
    return this.http.get(`${environment.api_url_base}/api/tasks/${id}/done`)
      .pipe(map(task => {
        return task;
      }));
  }




}
