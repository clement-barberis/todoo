export class Task {
  id: number;
  title: string;
  comment: string;
  priority: number;
  created_at: string;
  done: boolean;
  constructor(title, comment) {
    this.title = title;
    this.comment = comment;
    this.priority =0;
  }
}
