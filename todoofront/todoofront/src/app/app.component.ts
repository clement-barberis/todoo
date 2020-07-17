import { Component } from '@angular/core';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'todoofront';

  constructor(private toastr: ToastrService) {

    this.toastr.info('<a href="https://api.todoo.barberis.dev/api" target="_blank" > https://api.todoo.barberis.dev/api </a>', 'URL API', {
      disableTimeOut: true,
      enableHtml: true,
      tapToDismiss: false,
      closeButton: true
    });
    this.toastr.info('<a href="https://github.com/clement-barberis/todoo" target="_blank"> https://github.com/clement-barberis/todoo </a>', 'URL CODE SOURCE', {
      disableTimeOut: true,
      enableHtml: true,
      tapToDismiss: false,
      closeButton: true
    });
    this.toastr.warning('Ce site internet est uniquement à but démonstratif et n\'est pas héberger sur un environnement de production.', 'Environnement de test', {
      disableTimeOut: true,
      enableHtml: true,
      tapToDismiss: false,
      closeButton: true
    });
  }


}
