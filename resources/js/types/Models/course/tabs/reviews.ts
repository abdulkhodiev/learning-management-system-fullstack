import { Course } from "../../course"

export interface Review {
  id: number
  rate: number
  comment: string
  user: {
    id: number
    name: string
  }
  course: Course
}

export type TotalInfo = {
  number_of_reviews: number
  number_of_reviews_with_rate_5: number
  number_of_reviews_with_rate_4: number
  number_of_reviews_with_rate_3: number
  number_of_reviews_with_rate_2: number
  number_of_reviews_with_rate_1: number
}
