
export interface MetApiResponse {
  benchmark: number
  status: 'success' | 'failure'
  query: {
    options: Record<string, any>
    params: Record<string, any>
  }
  paginate?: {
    current_page: number
    first_item: number
    last_item: number
    last_page: number
    pages: Array<number>
    per_page: number
    total: number
  }
  data: any
}

export interface User {
  name: string
  email: string
  id: number
  phone: string
  address: string
  city: string
  state: string
  zip: string
  github: string
  avatar: string
}

export interface Experience {
  company: string
  title: string
  start_date: string
  end_date: string
  description: string
  id: number
  user_id: number
  isNew?: boolean
}

export interface Skill {
  description: string
  years_experience: string
  user_id: number
  id: number
}

export interface Interest {
  description: string
  user_id: number
  id: number
}

export type Users = Array<User>
export type Experiences = Array<Experience>
export type Skills = Array<Skill>
export type Interests = Array<Interest>
