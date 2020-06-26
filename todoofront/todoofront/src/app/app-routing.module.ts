import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import {AuthGuard} from './helpers/auth.guard';
import {HomeComponent} from './components/home/home.component';
import {TasksComponent} from './components/tasks/tasks.component';
import {AddtaskComponent} from './components/addtask/addtask.component';


const routes: Routes = [
  { path: "login", component: LoginComponent },
  {
    path: 'home',
    component: HomeComponent,
    canActivate: [AuthGuard] ,
    children: [
      {path: 'list', component: TasksComponent },
      {path: 'add', component: AddtaskComponent},
      {path: '**', redirectTo:'list', pathMatch:'full'}
    ]
  },
  { path: '**' ,redirectTo: 'login', pathMatch:'full'},



];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
