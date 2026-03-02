# Class Booking System - Documentation

## Overview
This document explains the comprehensive class booking system implemented for TN Veterans Security. The system manages in-person classes with capacity limits, deposits, payments, and QuickBooks integration.

## Database Structure

### 1. Services (Classes) Table - Enhanced
**New Fields Added:**
- `price` - Full class price (decimal)
- `deposit_amount` - Required deposit amount (decimal)
- `duration_hours` - Class duration in hours (integer)
- `max_students` - Maximum students per class (default: 10)
- `min_students` - Minimum students required (default: 2, can be 2 or 4)
- `class_type` - 'group' or 'one-on-one' (enum)
- `has_online_parts` - Boolean flag if class has online components
- `testing_in_person` - Boolean flag (always true for testing)

### 2. Class Schedules Table (NEW)
Stores scheduled class instances with:
- `service_id` - Foreign key to services
- `class_date` - Date of the class
- `start_time` - Class start time
- `end_time` - Calculated end time
- `duration_hours` - Override service duration if needed
- `max_students` - Override service max if needed (default: 10)
- `min_students` - Override service min if needed (default: 2)
- `current_students` - Track enrolled students (default: 0)
- `room` - Room name/number
- `instructor` - Instructor name
- `can_overlap` - Boolean flag for overlapping classes
- `status` - 'scheduled', 'full', 'cancelled', 'completed'

### 3. Service Bookings Table - Enhanced
**New Fields Added:**
- `class_schedule_id` - Links to specific scheduled class
- `total_amount` - Total booking amount
- `deposit_amount` - Deposit paid
- `remaining_amount` - Remaining balance
- `payment_status` - 'pending', 'deposit_paid', 'fully_paid', 'refunded'
- `booking_type` - 'group' or 'one-on-one'
- `number_of_students` - For group bookings (default: 1)
- `group_name` - Optional group identifier

### 4. Payments Table (NEW)
Tracks all payments and deposits:
- `booking_id` - Foreign key to service_bookings
- `customer_id` - Foreign key to customers
- `amount` - Payment amount
- `payment_type` - 'deposit', 'full_payment', 'remaining_balance', 'refund'
- `payment_method` - 'credit_card', 'debit_card', 'bank_transfer', 'cash', 'check', 'other'
- `status` - 'pending', 'completed', 'failed', 'refunded'
- `transaction_id` - Gateway transaction ID
- `payment_gateway` - Stripe, PayPal, etc.
- **QuickBooks Integration Fields:**
  - `synced_to_quickbooks` - Boolean flag
  - `quickbooks_invoice_id` - QuickBooks invoice reference
  - `quickbooks_payment_id` - QuickBooks payment reference
  - `quickbooks_synced_at` - Sync timestamp
- **Bank Account Sync Fields:**
  - `synced_to_bank` - Boolean flag
  - `bank_synced_at` - Sync timestamp

## Booking Rules & Logic

### Class Capacity Management
1. **Maximum Students**: 10 students per class (configurable per service/schedule)
2. **Minimum Students**: 2 or 4 students depending on course (configurable)
3. **Multiple Classes Same Day**: ✅ Allowed - classes can happen on the same day
4. **Class Overlap**: ✅ Allowed - classes can overlap in the same room if `can_overlap` is true
5. **Full Class Prevention**: ✅ System automatically stops new bookings when class reaches max capacity

### Booking Flow
1. Customer browses services (classes) on website
2. Customer selects a service and views available class schedules
3. System shows:
   - Available dates and times
   - Number of spots remaining
   - Price and deposit amount
   - Class duration and details
4. Customer selects a schedule and provides:
   - Number of students (for group bookings)
   - Group name (optional)
   - Booking type (group or one-on-one)
5. Customer pays deposit to confirm booking
6. System validates:
   - Class has available spots
   - Does not exceed maximum capacity
   - Deposit amount is paid
7. Booking is confirmed and class capacity is updated
8. Payment is tracked and synced to QuickBooks (when implemented)

### Booking Statuses
- **pending** - Booking created but deposit not paid
- **confirmed** - Deposit paid, booking confirmed
- **completed** - Class completed
- **cancelled** - Booking cancelled

### Payment Statuses
- **pending** - No payment received
- **deposit_paid** - Deposit paid, remaining balance due
- **fully_paid** - Full amount paid
- **refunded** - Payment refunded

## Booking Options for Students

### 1. Group Class Booking (Default)
- Students join scheduled group classes
- Minimum 2 or 4 students required (depending on course)
- Maximum 10 students per class
- Shared class experience
- Lower cost per student
- Fixed schedule dates and times

### 2. One-on-One Training
- Custom scheduling (flexible dates/times)
- Individual attention
- Personalized pace
- Higher cost (typically premium pricing)
- No minimum student requirement
- No maximum student limit (only instructor availability)

### 3. Booking Features
**For Group Classes:**
- View available class schedules
- See number of spots remaining
- Book for multiple students (group booking)
- Pay deposit to reserve spots
- Automatic capacity management

**For One-on-One:**
- Request preferred dates/times
- Custom duration (if needed)
- Direct instructor contact
- Premium pricing structure

## Models & Relationships

### Service Model
- `classSchedules()` - Has many class schedules
- `bookings()` - Has many bookings
- `availableSchedules()` - Get available upcoming schedules
- `hasAvailableSpots()` - Check if service has available spots
- `getNextAvailableDate()` - Get next available class date

### ClassSchedule Model
- `service()` - Belongs to service
- `bookings()` - Has many bookings
- `confirmedBookings()` - Get confirmed bookings
- `hasAvailableSpots()` - Check availability
- `getAvailableSpots()` - Get spots remaining
- `meetsMinimumStudents()` - Check minimum requirement
- `isFull()` - Check if class is full
- `incrementStudentCount()` - Add students
- `decrementStudentCount()` - Remove students

### ServiceBooking Model
- `customer()` - Belongs to customer
- `service()` - Belongs to service
- `classSchedule()` - Belongs to class schedule
- `payments()` - Has many payments
- `hasPaidDeposit()` - Check deposit status
- `isFullyPaid()` - Check full payment status
- `getTotalPaid()` - Get total paid amount

### Payment Model
- `booking()` - Belongs to booking
- `customer()` - Belongs to customer
- `markSyncedToQuickBooks()` - Sync to QuickBooks
- `markSyncedToBank()` - Sync to bank

## Next Steps for Implementation

### Admin Panel
1. ✅ Update ServiceController - Add pricing/class fields in create/edit forms
2. ⏳ Create ClassScheduleController - Manage scheduled classes
3. ⏳ Create BookingManagementController - View/manage all bookings
4. ⏳ Update admin views - Add class schedule management interface

### Customer Panel
1. ⏳ Create booking views - Available classes, booking form
2. ⏳ Update BookingController - Add booking creation methods
3. ⏳ Implement payment processing - Deposit payment integration
4. ⏳ Update service details page - Add "Book Now" button

### Payment Integration
1. ⏳ Integrate payment gateway (Stripe/PayPal)
2. ⏳ QuickBooks API integration
3. ⏳ Bank account sync functionality

## API Endpoints Needed

### Admin Routes
- `GET /admin/class-schedules` - List all class schedules
- `POST /admin/class-schedules` - Create new schedule
- `PUT /admin/class-schedules/{id}` - Update schedule
- `DELETE /admin/class-schedules/{id}` - Delete schedule
- `GET /admin/bookings` - List all bookings
- `PUT /admin/bookings/{id}/status` - Update booking status

### Customer Routes
- `GET /customer/book-class/{serviceId}` - Show available classes
- `POST /customer/bookings` - Create new booking
- `POST /customer/bookings/{id}/pay-deposit` - Pay deposit
- `GET /customer/bookings/{id}/payment` - View payment details

## QuickBooks Integration Points

1. **Invoice Creation**: When deposit is paid, create QuickBooks invoice
2. **Payment Recording**: Record payment in QuickBooks
3. **Sync Status**: Track sync status in payments table
4. **Error Handling**: Handle sync failures and retries

## Testing Scenarios

1. ✅ Class reaches maximum capacity - booking disabled
2. ✅ Minimum students not met - class cancelled, notify customers
3. ✅ Multiple classes same day - verify no conflicts
4. ✅ Overlapping classes same room - verify allowed
5. ✅ Deposit payment - verify booking confirmation
6. ✅ Payment tracking - verify payment records
7. ✅ Capacity updates - verify student count updates

## Notes

- Classes are primarily in-person (people come to class)
- Some classes may have online parts, but testing is always in-person
- Groups can join classes together
- System automatically prevents overbooking
- Full classes show as "Full" and stop accepting new bookings
