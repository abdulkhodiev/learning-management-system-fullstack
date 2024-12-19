export interface Commission {
  order_id: number
  customer: string
  type: number
  date: number
  status: string
  commission: string
}

export type CommissionsIndex = {
  data: Commission[]
  lifetime_commissions: number
  lifetime_received_commissions: number
  lifetime_pending_commissions: number
}
