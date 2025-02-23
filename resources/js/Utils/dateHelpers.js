import { formatDistance as formatDistanceFn } from 'date-fns'

export const formatDistance = (date) => {
  return formatDistanceFn(new Date(date), new Date(), { addSuffix: true })
} 