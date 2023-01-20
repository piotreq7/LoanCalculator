@calculate-loan
Feature: Calculate loan
  @content-page-get
  Scenario: Calculation happy path
    Given calculate loan and assign result to "result" with data:
    |numberOfMonths| 24 |
    |loanAmount    |2750|
    And the "result" is equal "115.0"
    Given calculate loan and assign result to "result" with data:
      |numberOfMonths| 3 |
      |loanAmount    |11500|
    And the "result" is equal "460"
    Given calculate loan and assign result to "result" with data:
      |numberOfMonths| 12 |
      |loanAmount    |19250|
    And the "result" is equal "385.0"