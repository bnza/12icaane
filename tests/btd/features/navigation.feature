Feature: 12th ICAANE site navigation behaviour

  Scenario Outline: Navigate to URLs
    Given I am not logged in
    When I navigate to "<request_url>"
    Then I got <status> status
    And I land to "<land_url>"

    Examples:
      | request_url   | status | land_url  |
      | /             | 200    | /         |
      | /register     | 200    | /register |
      | /confirmation | 200    | /         |