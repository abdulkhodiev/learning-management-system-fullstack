import { Role } from "./role"

export interface User {
  id: number
  first_name: string
  last_name: string
  username: string
  email: string
  role: Role
  created_at: string
  updated_at: string
}
