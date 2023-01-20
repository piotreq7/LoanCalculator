@calculate-loan
Feature: Calculate loan
  @calculate-loan-integers
  Scenario: Calculation happy path integers
    Given calculate loan and assign result to "fee" with data:
    |numberOfMonths| 24  |
    |loanAmount    |2750|
    And the "fee" is equal "115.00"
    Given calculate loan and assign result to "fee" with data:
      |numberOfMonths| 24  |
      |loanAmount    |11500|
    And the "fee" is equal "460.00"
    Given calculate loan and assign result to "fee" with data:
      |numberOfMonths| 12  |
      |loanAmount    |19250|
    And the "fee" is equal "385.00"
    Given calculate loan and assign result to "fee" with data:
      |numberOfMonths| 12 |
      |loanAmount    | 1  |
    And the "fee" is equal "4.00"

  @calculate-loan-max
  Scenario: Calculation happy path max
    Given calculate loan and assign result to "fee" with data:
      |numberOfMonths| 24      |
      |loanAmount    | 20000   |
    And the "fee" is equal "800.00"

  @calculate-loan-float
  Scenario: Calculation happy path float
    Given calculate loan and assign result to "fee" with data:
      |numberOfMonths | 12    |
      |loanAmount     | 1.33  |
    And the "fee" is equal "3.67"
    Given calculate loan and assign result to "fee" with data:
      |numberOfMonths | 24        |
      |loanAmount     |19999.99   |
    And the "fee" is equal "800.01"