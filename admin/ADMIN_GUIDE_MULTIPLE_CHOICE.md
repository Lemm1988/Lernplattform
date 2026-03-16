# Administrator Guide - Multiple-Choice Questions

## Overview

This guide provides comprehensive instructions for administrators on how to create and manage multiple-choice questions in the quiz system. The new functionality allows for both traditional single-choice questions (radio buttons) and new multiple-choice questions (checkboxes).

## Table of Contents

1. [Question Types Overview](#question-types-overview)
2. [Creating Single-Choice Questions](#creating-single-choice-questions)
3. [Creating Multiple-Choice Questions](#creating-multiple-choice-questions)
4. [Managing Existing Questions](#managing-existing-questions)
5. [Code Examples in Questions](#code-examples-in-questions)
6. [Best Practices](#best-practices)
7. [Troubleshooting](#troubleshooting)
8. [FAQ](#faq)

## Question Types Overview

### Single-Choice Questions
- **Display**: Radio buttons (○)
- **User Selection**: Only one answer can be selected
- **Scoring**: All-or-nothing (100% or 0%)
- **Use Case**: Questions with exactly one correct answer

### Multiple-Choice Questions
- **Display**: Checkboxes (☐)
- **User Selection**: Multiple answers can be selected
- **Scoring**: Proportional based on correct selections
- **Use Case**: Questions with multiple correct answers

## Creating Single-Choice Questions

### Step-by-Step Process

1. **Access Question Management**
   - Navigate to Admin Dashboard
   - Click on "Question Management"
   - Click "Create New Question"

2. **Basic Question Information**
   ```
   Question Text: [Enter your question]
   Question Type: Single Choice (default)
   Learning Field: [Select appropriate field]
   Difficulty: [Easy/Medium/Hard]
   Points: [Number of points for correct answer]
   ```

3. **Answer Options**
   - Add 2-6 answer options
   - Mark exactly ONE option as correct
   - Use clear, concise answer text
   - Order answers logically

4. **Review and Save**
   - Preview the question
   - Verify correct answer is marked
   - Save the question

### Example Single-Choice Question

```
Question: What is the capital of Germany?
Type: Single Choice
Points: 1

Answer Options:
○ Berlin (Correct)
○ Munich
○ Hamburg
○ Frankfurt
```

## Creating Multiple-Choice Questions

### Step-by-Step Process

1. **Access Question Management**
   - Navigate to Admin Dashboard
   - Click on "Question Management"
   - Click "Create New Question"

2. **Basic Question Information**
   ```
   Question Text: [Enter your question]
   Question Type: Multiple Choice ← Select this option
   Learning Field: [Select appropriate field]
   Difficulty: [Easy/Medium/Hard]
   Points: [Number of points for all correct answers]
   ```

3. **Answer Options**
   - Add 3-8 answer options
   - Mark ALL correct options as correct
   - Include at least one incorrect option
   - Ensure logical distribution of correct/incorrect answers

4. **Review and Save**
   - Preview the question with checkboxes
   - Verify all correct answers are marked
   - Test the scoring logic
   - Save the question

### Example Multiple-Choice Question

```
Question: Which of the following are programming languages?
Type: Multiple Choice
Points: 2

Answer Options:
☑ PHP (Correct)
☑ JavaScript (Correct)
☐ HTML (Incorrect)
☑ Python (Correct)
☐ CSS (Incorrect)
```

## Managing Existing Questions

### Viewing Questions
- **Question List**: Shows question type in a dedicated column
- **Filtering**: Filter by question type (Single/Multiple)
- **Search**: Search works across all question types
- **Sorting**: Sort by type, difficulty, points, etc.

### Editing Questions

#### Changing Question Type
⚠️ **Warning**: Changing question type affects scoring and user experience

1. **Single to Multiple**:
   - Review answer options
   - Mark additional correct answers if needed
   - Adjust point values accordingly
   - Test thoroughly before publishing

2. **Multiple to Single**:
   - Ensure only one answer is marked correct
   - Review point values
   - Consider impact on existing quiz sessions

#### Best Practices for Editing
- Always test questions after editing
- Notify users of significant changes
- Keep backup of original questions
- Document changes for audit trail

### Bulk Operations
- **Export**: Export questions with type information
- **Import**: Import questions with type specification
- **Duplicate**: Maintain question type when duplicating
- **Delete**: Standard deletion process applies

## Code Examples in Questions

### Adding Code to Questions

1. **In Question Text**:
   ```html
   What does the following PHP code output?
   
   <pre><code class="language-php">
   <?php
   $x = 5;
   $y = 10;
   echo $x + $y;
   ?>
   </code></pre>
   ```

2. **In Answer Options**:
   ```html
   Answer: <code>echo "Hello World";</code>
   ```

### Supported Languages
- PHP
- JavaScript
- Python
- Java
- C/C++
- HTML/CSS
- SQL

### Security Considerations
- All code is automatically HTML-escaped
- XSS protection is built-in
- No executable code is processed
- Safe for display in all contexts

### Formatting Guidelines
- Use `<pre><code>` for code blocks
- Use `<code>` for inline code
- Specify language class for syntax highlighting
- Keep code examples concise and relevant

## Best Practices

### Question Design

#### Single-Choice Questions
- **Clear Correct Answer**: Only one obviously correct option
- **Plausible Distractors**: Wrong answers should be believable
- **Avoid "All of the above"**: Can be confusing
- **Consistent Length**: Keep answer options similar length

#### Multiple-Choice Questions
- **Clear Instructions**: Make it obvious multiple selections are expected
- **Balanced Options**: Mix of correct and incorrect answers
- **Avoid Overlapping**: Ensure answers don't contradict each other
- **Logical Grouping**: Related concepts should be grouped together

### Content Guidelines

#### Question Text
- Use clear, unambiguous language
- Avoid double negatives
- Include all necessary context
- Keep questions focused on single concepts

#### Answer Options
- Use parallel structure
- Avoid "None of the above" in multiple-choice
- Make incorrect options plausible
- Ensure grammatical consistency

### Technical Considerations

#### Point Values
- **Single-Choice**: Typically 1-3 points
- **Multiple-Choice**: Higher values (2-5 points) due to complexity
- **Consistency**: Similar difficulty questions should have similar points

#### Difficulty Levels
- **Easy**: Basic recall, simple concepts
- **Medium**: Application, analysis
- **Hard**: Synthesis, complex problem-solving

## Troubleshooting

### Common Issues

#### Question Not Displaying Correctly
**Symptoms**: Question shows wrong input type (radio vs checkbox)
**Solution**: 
1. Check question_type field in database
2. Verify question was saved with correct type
3. Clear browser cache
4. Check for JavaScript errors

#### Scoring Issues
**Symptoms**: Incorrect point calculation for multiple-choice
**Solution**:
1. Verify all correct answers are marked
2. Check point values are set correctly
3. Test with known answer combinations
4. Review scoring algorithm in ResultsCalculator

#### Code Examples Not Formatting
**Symptoms**: Code appears as plain text without formatting
**Solution**:
1. Check HTML structure of code blocks
2. Verify CSS classes are applied
3. Ensure syntax highlighting CSS is loaded
4. Test with different browsers

#### Import/Export Problems
**Symptoms**: Question types not preserved during import/export
**Solution**:
1. Verify CSV/JSON format includes question_type field
2. Check import script handles question types
3. Validate data before import
4. Test with small sample first

### Database Issues

#### Missing question_type Column
```sql
-- Check if column exists
DESCRIBE questions;

-- Add column if missing
ALTER TABLE questions 
ADD COLUMN question_type ENUM('single', 'multiple') NOT NULL DEFAULT 'single';
```

#### Orphaned Answer Selections
```sql
-- Check for orphaned records
SELECT COUNT(*) FROM user_answer_selections uas
LEFT JOIN user_answers ua ON uas.user_answer_id = ua.id
WHERE ua.id IS NULL;

-- Clean up orphaned records
DELETE uas FROM user_answer_selections uas
LEFT JOIN user_answers ua ON uas.user_answer_id = ua.id
WHERE ua.id IS NULL;
```

### Performance Issues

#### Slow Question Loading
- Check database indexes on question_type column
- Optimize queries with EXPLAIN
- Consider caching for frequently accessed questions
- Monitor database performance metrics

#### Large Result Sets
- Implement pagination for question lists
- Add filtering options
- Optimize JOIN queries
- Consider database partitioning for large datasets

## FAQ

### General Questions

**Q: Can I convert existing single-choice questions to multiple-choice?**
A: Yes, but carefully review the answer options and ensure multiple correct answers exist. Test thoroughly before publishing.

**Q: How are multiple-choice questions scored?**
A: Scoring is proportional. If a question has 3 correct answers worth 3 points total, selecting 2 correct answers gives 2 points, minus any points for incorrect selections.

**Q: Can I mix single-choice and multiple-choice questions in the same quiz?**
A: Yes, the system automatically handles mixed question types within a single quiz session.

**Q: What's the maximum number of answer options?**
A: While there's no hard limit, we recommend 4-6 options for single-choice and 4-8 for multiple-choice questions for optimal user experience.

### Technical Questions

**Q: How do I backup questions before making changes?**
A: Use the export functionality to create a backup file, or create a database backup before making bulk changes.

**Q: Can I use HTML in question text?**
A: Yes, but it's automatically sanitized for security. Use the code formatting features for code examples.

**Q: How do I report bugs or request features?**
A: Contact the development team through the admin support channel or create a ticket in the issue tracking system.

### Troubleshooting Questions

**Q: Why don't my code examples show syntax highlighting?**
A: Ensure you're using the correct HTML structure with `<pre><code class="language-xxx">` and that the CSS files are loaded properly.

**Q: Students report they can't select multiple answers on my multiple-choice question.**
A: Verify the question type is set to "Multiple Choice" and that the question was saved correctly. Check browser compatibility.

**Q: The scoring seems wrong for my multiple-choice questions.**
A: Review which answers are marked as correct, verify the point values, and test with known answer combinations to validate the scoring logic.

## Support and Resources

### Getting Help
- **Technical Support**: [admin-support@example.com]
- **User Documentation**: Available in the help section
- **Training Materials**: Contact training team for workshops
- **Community Forum**: [forum.example.com/admin]

### Additional Resources
- **Video Tutorials**: Available in admin dashboard
- **Best Practices Guide**: Detailed pedagogical guidelines
- **API Documentation**: For advanced integrations
- **Change Log**: Track system updates and new features

---

**Document Version**: 1.0  
**Last Updated**: [Current Date]  
**Next Review**: [Quarterly]  
**Maintained By**: Development Team