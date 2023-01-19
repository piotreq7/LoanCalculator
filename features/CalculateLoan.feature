@calculate-loan
Feature: Calculate loan
  @content-page-get
  Scenario: Calculation happy path
    Given calculate loan with data:
    |numberOfMonths| 12 |
    |loanAmount    |2000|
    |result        |10  |