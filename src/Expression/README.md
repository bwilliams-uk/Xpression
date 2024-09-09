# Structure of Xpression\Exception Namespace

> Requires Update

**Expression**
- Holds the working state of an Expression during its resolution.
- Provides access to substrings of the expression through methods: nextBracket, nextFunction, nextOperation and nextVariable.


**ExpressionSolver**
- The process for resolving an Expression in the context of an Environment which provides available variable and functions.


**ExpressionSubstring**
Child Classes: BracketSubstring, FunctionSubstring, OperationSubstring, Variable Instance

Represent a part of the overall Expression.

These object are created by the Expression object, to be used by the ExpressionSolver object.
All ExpressionSubstrings have a substitute($value) method which enables the ExpressionSolver to update
the associated expression accordingly.