export interface Course {
  id: number
  title: string
  description: string
  image: string
  category_id: number
  mentor_id: number
  price: number
  languages: string[]
  created_at: string
  updated_at: string
}

export type CourseWithDetails = Course & {
  number_of_lessons: number
  number_of_chapters: number
  number_of_orders: number
  number_of_reviews: number
  average_rating: number
}
