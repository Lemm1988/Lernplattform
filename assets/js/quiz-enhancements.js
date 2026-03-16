/**
 * Quiz Enhancement JavaScript
 * Provides progressive enhancement for quiz functionality
 * Ensures graceful degradation when JavaScript is disabled
 */

(function() {
    'use strict';

    // Quiz enhancement object
    const QuizEnhancement = {
        
        // Initialize all enhancements
        init: function() {
            this.setupFormValidation();
            this.setupProgressiveEnhancements();
            this.setupAccessibilityEnhancements();
            this.setupKeyboardNavigation();
            this.setupVisualFeedback();
        },

        // Client-side form validation
        setupFormValidation: function() {
            const quizForms = document.querySelectorAll('form[method="post"]');
            
            quizForms.forEach(form => {
                // Skip if form already has validation
                if (form.hasAttribute('data-quiz-enhanced')) {
                    return;
                }
                
                form.setAttribute('data-quiz-enhanced', 'true');
                
                form.addEventListener('submit', function(event) {
                    const isValid = QuizEnhancement.validateForm(this);
                    
                    if (!isValid) {
                        event.preventDefault();
                        event.stopPropagation();
                        QuizEnhancement.showValidationErrors(this);
                    }
                });
            });
        },

        // Validate form based on question type
        validateForm: function(form) {
            const questionType = this.getQuestionType(form);
            let isValid = true;
            let errorMessage = '';

            if (questionType === 'single') {
                const radioInputs = form.querySelectorAll('input[type="radio"][name="answer_id"]');
                const isSelected = Array.from(radioInputs).some(input => input.checked);
                
                if (!isSelected) {
                    isValid = false;
                    errorMessage = 'Bitte wählen Sie eine Antwort aus.';
                }
            } else if (questionType === 'multiple') {
                const checkboxInputs = form.querySelectorAll('input[type="checkbox"][name="answer_ids[]"]');
                const isSelected = Array.from(checkboxInputs).some(input => input.checked);
                
                if (!isSelected) {
                    isValid = false;
                    errorMessage = 'Bitte wählen Sie mindestens eine Antwort aus.';
                }
            }

            // Store error message for display
            if (!isValid) {
                form.setAttribute('data-error-message', errorMessage);
            } else {
                form.removeAttribute('data-error-message');
            }

            return isValid;
        },

        // Determine question type from form inputs
        getQuestionType: function(form) {
            if (form.querySelector('input[type="checkbox"][name="answer_ids[]"]')) {
                return 'multiple';
            } else if (form.querySelector('input[type="radio"][name="answer_id"]')) {
                return 'single';
            }
            return 'unknown';
        },

        // Show validation errors
        showValidationErrors: function(form) {
            // Remove existing error messages
            const existingErrors = form.querySelectorAll('.quiz-validation-error');
            existingErrors.forEach(error => error.remove());

            const errorMessage = form.getAttribute('data-error-message');
            if (errorMessage) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger quiz-validation-error mt-3';
                errorDiv.setAttribute('role', 'alert');
                errorDiv.innerHTML = `
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    ${errorMessage}
                `;

                // Insert before submit button
                const submitButton = form.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.parentNode.insertBefore(errorDiv, submitButton);
                } else {
                    form.appendChild(errorDiv);
                }

                // Focus first invalid input
                this.focusFirstInvalidInput(form);
            }
        },

        // Focus first invalid input for accessibility
        focusFirstInvalidInput: function(form) {
            const questionType = this.getQuestionType(form);
            let firstInput = null;

            if (questionType === 'single') {
                firstInput = form.querySelector('input[type="radio"][name="answer_id"]');
            } else if (questionType === 'multiple') {
                firstInput = form.querySelector('input[type="checkbox"][name="answer_ids[]"]');
            }

            if (firstInput) {
                firstInput.focus();
            }
        },

        // Progressive enhancement features
        setupProgressiveEnhancements: function() {
            // Add visual feedback for selections
            this.setupSelectionFeedback();
            
            // Add confirmation for form submission
            this.setupSubmissionConfirmation();
            
            // Add auto-save functionality (optional)
            this.setupAutoSave();
        },

        // Visual feedback for answer selections
        setupSelectionFeedback: function() {
            const inputs = document.querySelectorAll('input[type="radio"], input[type="checkbox"]');
            
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    QuizEnhancement.updateSelectionFeedback(this);
                });
            });
        },

        // Update visual feedback when selection changes
        updateSelectionFeedback: function(input) {
            const formCheck = input.closest('.form-check');
            const form = input.closest('form');
            
            if (!formCheck || !form) return;

            // Remove validation errors when user makes selection
            const errors = form.querySelectorAll('.quiz-validation-error');
            errors.forEach(error => error.remove());

            // Add visual feedback class
            if (input.checked) {
                formCheck.classList.add('selected');
            } else {
                formCheck.classList.remove('selected');
            }

            // For radio buttons, unselect others
            if (input.type === 'radio') {
                const otherRadios = form.querySelectorAll(`input[type="radio"][name="${input.name}"]`);
                otherRadios.forEach(radio => {
                    if (radio !== input) {
                        const otherFormCheck = radio.closest('.form-check');
                        if (otherFormCheck) {
                            otherFormCheck.classList.remove('selected');
                        }
                    }
                });
            }
        },

        // Submission confirmation
        setupSubmissionConfirmation: function() {
            const submitButtons = document.querySelectorAll('button[type="submit"]');
            
            submitButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    // Add loading state
                    const originalText = this.innerHTML;
                    this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Speichere...';
                    this.disabled = true;

                    // Re-enable if form validation fails
                    setTimeout(() => {
                        const form = this.closest('form');
                        if (form && !QuizEnhancement.validateForm(form)) {
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }
                    }, 100);
                });
            });
        },

        // Auto-save functionality (stores selections in localStorage)
        setupAutoSave: function() {
            const sessionId = this.getSessionId();
            if (!sessionId) return;

            const inputs = document.querySelectorAll('input[type="radio"], input[type="checkbox"]');
            
            // Load saved selections
            this.loadSavedSelections(sessionId);
            
            // Save selections on change
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    QuizEnhancement.saveSelection(sessionId, this);
                });
            });
        },

        // Get session ID from URL or form
        getSessionId: function() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('session_id');
        },

        // Save selection to localStorage
        saveSelection: function(sessionId, input) {
            try {
                const key = `quiz_${sessionId}_selections`;
                let selections = JSON.parse(localStorage.getItem(key) || '{}');
                
                if (input.type === 'radio') {
                    selections[input.name] = input.value;
                } else if (input.type === 'checkbox') {
                    if (!selections[input.name]) {
                        selections[input.name] = [];
                    }
                    
                    if (input.checked) {
                        if (!selections[input.name].includes(input.value)) {
                            selections[input.name].push(input.value);
                        }
                    } else {
                        selections[input.name] = selections[input.name].filter(val => val !== input.value);
                    }
                }
                
                localStorage.setItem(key, JSON.stringify(selections));
            } catch (e) {
                // Ignore localStorage errors
                console.warn('Could not save quiz selection:', e);
            }
        },

        // Load saved selections from localStorage
        loadSavedSelections: function(sessionId) {
            try {
                const key = `quiz_${sessionId}_selections`;
                const selections = JSON.parse(localStorage.getItem(key) || '{}');
                
                Object.keys(selections).forEach(name => {
                    const value = selections[name];
                    
                    if (Array.isArray(value)) {
                        // Checkbox selections
                        value.forEach(val => {
                            const input = document.querySelector(`input[type="checkbox"][name="${name}"][value="${val}"]`);
                            if (input) {
                                input.checked = true;
                                this.updateSelectionFeedback(input);
                            }
                        });
                    } else {
                        // Radio selection
                        const input = document.querySelector(`input[type="radio"][name="${name}"][value="${value}"]`);
                        if (input) {
                            input.checked = true;
                            this.updateSelectionFeedback(input);
                        }
                    }
                });
            } catch (e) {
                // Ignore localStorage errors
                console.warn('Could not load quiz selections:', e);
            }
        },

        // Accessibility enhancements
        setupAccessibilityEnhancements: function() {
            // Add ARIA labels and descriptions
            this.enhanceAriaLabels();
            
            // Add live region for announcements
            this.setupLiveRegion();
            
            // Enhance focus management
            this.setupFocusManagement();
        },

        // Enhance ARIA labels
        enhanceAriaLabels: function() {
            const questionText = document.querySelector('.question-text, .card-title');
            if (questionText) {
                questionText.id = 'question-text';
                questionText.setAttribute('role', 'heading');
                questionText.setAttribute('aria-level', '2');
            }

            // Add question type announcement
            const form = document.querySelector('form[method="post"]');
            if (form) {
                const questionType = this.getQuestionType(form);
                const typeText = questionType === 'multiple' ? 'Mehrfachauswahl' : 'Einfachauswahl';
                
                if (questionText) {
                    const typeSpan = document.createElement('span');
                    typeSpan.className = 'visually-hidden';
                    typeSpan.textContent = ` (${typeText})`;
                    questionText.appendChild(typeSpan);
                }
            }
        },

        // Setup live region for announcements
        setupLiveRegion: function() {
            let liveRegion = document.getElementById('quiz-live-region');
            if (!liveRegion) {
                liveRegion = document.createElement('div');
                liveRegion.id = 'quiz-live-region';
                liveRegion.setAttribute('aria-live', 'polite');
                liveRegion.setAttribute('aria-atomic', 'true');
                liveRegion.className = 'visually-hidden';
                document.body.appendChild(liveRegion);
            }
        },

        // Announce message to screen readers
        announceToScreenReader: function(message) {
            const liveRegion = document.getElementById('quiz-live-region');
            if (liveRegion) {
                liveRegion.textContent = message;
                
                // Clear after announcement
                setTimeout(() => {
                    liveRegion.textContent = '';
                }, 1000);
            }
        },

        // Focus management
        setupFocusManagement: function() {
            // Ensure proper focus order
            const inputs = document.querySelectorAll('input[type="radio"], input[type="checkbox"]');
            inputs.forEach((input, index) => {
                input.setAttribute('tabindex', '0');
            });
        },

        // Keyboard navigation
        setupKeyboardNavigation: function() {
            const form = document.querySelector('form[method="post"]');
            if (!form) return;

            form.addEventListener('keydown', function(event) {
                QuizEnhancement.handleKeyboardNavigation(event, this);
            });
        },

        // Handle keyboard navigation
        handleKeyboardNavigation: function(event, form) {
            const questionType = this.getQuestionType(form);
            
            // Handle Enter key on labels
            if (event.key === 'Enter' && event.target.tagName === 'LABEL') {
                const input = form.querySelector(`#${event.target.getAttribute('for')}`);
                if (input) {
                    if (input.type === 'checkbox') {
                        input.checked = !input.checked;
                    } else if (input.type === 'radio') {
                        input.checked = true;
                    }
                    this.updateSelectionFeedback(input);
                    event.preventDefault();
                }
            }
            
            // Handle arrow keys for radio buttons
            if (questionType === 'single' && (event.key === 'ArrowUp' || event.key === 'ArrowDown')) {
                const radios = Array.from(form.querySelectorAll('input[type="radio"][name="answer_id"]'));
                const currentIndex = radios.findIndex(radio => radio === event.target);
                
                if (currentIndex !== -1) {
                    let nextIndex;
                    if (event.key === 'ArrowDown') {
                        nextIndex = (currentIndex + 1) % radios.length;
                    } else {
                        nextIndex = (currentIndex - 1 + radios.length) % radios.length;
                    }
                    
                    radios[nextIndex].focus();
                    radios[nextIndex].checked = true;
                    this.updateSelectionFeedback(radios[nextIndex]);
                    event.preventDefault();
                }
            }
        },

        // Visual feedback enhancements
        setupVisualFeedback: function() {
            // Add CSS classes for enhanced styling
            const form = document.querySelector('form[method="post"]');
            if (form) {
                const questionType = this.getQuestionType(form);
                form.classList.add(`question-${questionType}`);
                
                // Add question type indicator
                this.addQuestionTypeIndicator(form, questionType);
            }
        },

        // Add visual question type indicator
        addQuestionTypeIndicator: function(form, questionType) {
            const questionContainer = form.closest('.card-body') || form;
            const existingIndicator = questionContainer.querySelector('.question-type-indicator');
            
            if (!existingIndicator) {
                const indicator = document.createElement('div');
                indicator.className = `question-type-indicator question-type-${questionType}`;
                indicator.textContent = questionType === 'multiple' ? 'Mehrfachauswahl' : 'Einfachauswahl';
                
                const questionTitle = questionContainer.querySelector('.card-title, h5');
                if (questionTitle) {
                    questionTitle.parentNode.insertBefore(indicator, questionTitle);
                }
            }
        }
    };

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            QuizEnhancement.init();
        });
    } else {
        QuizEnhancement.init();
    }

    // Export for testing
    window.QuizEnhancement = QuizEnhancement;

})();