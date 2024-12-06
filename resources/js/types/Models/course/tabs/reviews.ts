import { Course } from "../../course"
import { User } from "../../user"

export interface Review {
  id: number
  rate: number
  comment: string
  user: User
  course: Course
}
