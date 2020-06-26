import { Component, OnInit } from '@angular/core';
import {AuthenticationService} from '../../services/authentication.service';
import {ActivatedRoute, Router} from '@angular/router';
import {TaskService} from '../../services/task.service';
import {first} from 'rxjs/operators';
import {Task} from '../../models/task';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  constructor(
    private authenticationService: AuthenticationService,
    private route: ActivatedRoute,
    private router: Router,

  ) {

  }

  ngOnInit(): void {

  }

  exit_app(){
    this.authenticationService.logout();
    this.router.navigate(['login']);
  }

  add_task(){
    this.router.navigate(['home/add']);
  }

}
